<?php

class processInst extends pstack {
	
	protected $processStepName, $processChain;
	protected $stack, $chain, $event; 
	public static $pdo;		
	
	public function __construct(& $caller, $callerName=null, $stack=null) {
				
		self::$pdo = $caller::$pdo;		
				
		parent::__construct($caller->env, 'kernelv2', $stack); 
		
		//$this->debug = true;//override;	
		
		//$this->event = null;
		$this->stack = (array) $stack; //get env chain
		$this->chain = $this->getProcessChain();
	}
	
	public function getProcessChain() 
	{
		if ($dac5 = $this->caller->ldscheme)
		{
			$c = file_get_contents($dac5 . '/srvProcessChain');
			return (array) json_decode($c);
		}
		else
			return (array) $this->caller->proc->getProcessChain(); //proc		
	}	
	
	
	public function isFinished($event=null) {
		if (!$this->isProcessUser()) 
			return false;
		
		$this->event = $event;
		return true;
	}	
	
	public function nextStep($event=null) {
		if ($this->getProcessStepInfo('isNext')) {
			return $this->getProcessStepInfo('caller') .'.'. $this->getNextInChain() .
				   (($e = ($event ? $event : $this->getProcessStepInfo('event'))) ? ' use ' . $e : null);	
		}	
		elseif ($this->getProcessStepInfo('isNextS')) {
			return $this->getNextInStack() .
				   (($e = ($event ? $event : $this->getProcessStepInfo('event'))) ? ' use ' . $e : null);				
		}
		
		return false;	
	}
	
	public function prevStep($event=null) { 
		if ($this->getProcessStepInfo('isPrev')) {
			return $this->getProcessStepInfo('caller') .'.'. $this->getPrevInChain() .
				   (($e = ($event ? $event : $this->getProcessStepInfo('event'))) ? ' use ' . $e : null);	
		}	
		elseif ($this->getProcessStepInfo('isPrevS')) {
			return $this->getPrevInStack() .
				   (($e = ($event ? $event : $this->getProcessStepInfo('event'))) ? ' use ' . $e : null);				
		}
		
		return false;
	}	
	
	public function step($event=null) {
		return $this->getProcessStepInfo('caller') .'.'. $this->getProcessStepInfo('name') .
			   (($e = ($event ? $event : $this->event)) ? ' use ' . $e : null);	
	}	

	//alias
	protected function getProcessChainName() {
		return $this->getProcessStepName();
	}

	//caller.processname.event
	protected function getFullStepName() {
		return str_replace(' use ', '.', $this->step($e));
	}	
	
	protected function getProcessStepInfo($param=null) {
		//chain 
		$isLast = $this->isLastInChain();
		$isPrev = $this->isPrevInChain();
		$isNext = $this->isNextInChain();
		
		$chainMax = $this->getChainCount();		
		$chainId = $this->getChainId();
		
		//stack
		$isLastS = $this->isLastInStack();
		$isPrevS = $this->isPrevInStack();
		$isNextS = $this->isNextInStack();
		
		$stackMax = $this->getStackCount();		
		$stackId = $this->getStackId();

		//process
		$pid = $this->isRunningProcess();	
		$isClosed = $this->isClosedProcess();
		
		$fn = $this->callerName .'.'. $this->processStepName;
		$pForm = $this->hasForm($fn) ? $fn : null;		
		$pData = $this->stackPost(true,$stackId,$chainId);
		
		$sid = md5(serialize($this->stack) .'|'. $this->pMethod);
		$pRunStatus = $this->processStatus(1, $pid, $sid, $stackId, $chainId);

		$c = array( 'name'=>$this->processStepName,
					'process'=>$this->processName,
					'caller'=>$this->callerName,
					'event'=>$this->event,	
					'method'=>$this->pMethod,
					'form'=>$pForm,
					'data'=>$pData,
			        'status'=>$pRunStatus,
					'closed'=>$isClosed,
					'pid'=>$pid,
					'chainId'=>$chainId,
					'chainMax'=>$chainMax,
		            'isLast'=>$isLast,
					'isPrev'=>$isPrev,
					'isNext'=>$isNext,
					'stackId'=>$stackId,
					'stackMax'=>$stackMax,
		            'isLastS'=>$isLastS,
					'isPrevS'=>$isPrevS,
					'isNextS'=>$isNextS,
					'stackmd5'=>$sid,
				);	
				
		return ($param) ? $c[$param] : $c;		
	}

	
	//chain methods	
	
	protected function getNextInChain() {
 		//$chain = $this->getProcessChain();
		$thisID = $this->getChainId()-1; 
		//print_r($chain); echo $thisID;
		return $this->chain[$thisID+1]; 
	}

	protected function getPrevInChain() {
 		//$chain = $this->getProcessChain();
		$thisID = $this->getChainId()-1;
		
		return $this->chain[$thisID-1];
	}		
	
	protected function isLastInChain() {
		if ($this->getChainId() == $this->getChainCount())
			return true;
		
		return false;
	}	
	
	protected function isPrevInChain() {
		if ($this->getChainId() > 1)
			return true;	
		
		return false;
	}	
	
	protected function isNextInChain() {
		if ($this->getChainId() < $this->getChainCount())
			return true;
		
		return false;
	}	
	

	protected function getChainCount() {
		return @count($this->chain);//$this->getProcessChain());
	}	
	
	protected function getChainId() {
 		//$chain = $this->getProcessChain();
		//if (empty($chain)) return 0;
		
		foreach ($this->chain as $id=>$chainName) {
			//echo PHP_EOL . $this->processStepName .':'. $chainName;
			if ($this->processStepName == $chainName)
				return ($id + 1);
		}
		
		return 0;
	}	

	//stack methods
	protected function getNextInStack() {
		$thisID = $this->getStackId()-1;	
		$i=0;
		foreach ($this->stack as $stackName=>$processChain) {
			if ($i==$thisID+1) {
				$sName = $this->getCallerNameInStack($stackName);
				return $sName .'.'. array_shift($processChain);
			}	
			$i+=1;	
		}
		return null;
	}

	protected function getPrevInStack() {
		$thisID = $this->getStackId()-1;
		$i=0;
		foreach ($this->stack as $stackName=>$processChain) {
			if ($i==$thisID-1) {
				$sName = $this->getCallerNameInStack($stackName);
				return $sName .'.'. array_pop($processChain);
			}	
			$i+=1;		
		}
		return null;
	}	
 	
	
	protected function isLastInStack() {
		if ($this->getStackId() == $this->getStackCount())
			return true;
		
		return false;
	}	
	
	protected function isPrevInStack() {
		if ($this->getStackId() > 1)
			return true;	
		
		return false;
	}	
	
	protected function isNextInStack() {
		if ($this->getStackId() < $this->getStackCount())
			return true;
		
		return false;
	}	
	

	protected function getStackCount() {

		return count($this->stack);
	}	
	
	protected function getStackId() {
 		$kStack = array_keys($this->stack);
		
		foreach ($kStack as $id=>$stackName) {
			
			$sName = $this->getCallerNameInStack($stackName);
			//echo $stackName , '>' , $sName;
			if ($sName == $this->callerName)
				return ($id + 1);
		}
		
		return 0;
	}	
	
	//update running stack step
	protected function stackRunStep($state=null) {	
	
		if ($this->isRunningProcess())  {
			
			$cid = $this->getChainId();
			$sid = $this->getStackId();
			$pstate = $state ? 1 : 0;	
		
			$final = $this->stackRunSave($pstate, $sid, $cid);
			if (!$final)		
				$this->setFormStack();
			
			return true;//($ret);
		}	
		
		return false;
	}
	
	//return post data else rid
	protected function stackPostStep($data=false) {

		if ($this->isRunningProcess())  {		

			$cid = $this->getChainId();
			$sid = $this->getStackId();
			//echo $cid . ':' . $sid;
			
			//check if process has post
			$ret = $this->stackPost($data, $sid, $cid);
			return ($ret);
		}
		return false; 				
	}	
	
	//override
	protected function setFormStack($form=null) {
		$f = $form ? $form : $this->callerName .'.'. $this->processStepName;

		if (!$this->stackPostStep()) 	
			return parent::setFormStack($f);	

		return false;
	}	
	
	//misc	
	
	protected function debug($event=null) {
		if ($this->debug) {
			echo ($ps = $this->prevStep($event)) ? PHP_EOL . 'Prev step:' . $ps : null;
			echo PHP_EOL . 'Step:' . $this->step($event);
			echo ($ns = $this->nextStep($event)) ? PHP_EOL . 'Next step:' . $ns : null ;
							
			//echo '<pre>';
			print_r($this->getProcessStepInfo());
			//echo '</pre>';
		}		
	}
	
	//test
	protected function runCode($status=0, $event=null) {
		$formName = $this->callerName .'.'. $this->processStepName;// . ($event ? '.'.$event : null);
		
		//crm forms
		/*$sSQL = "select codedata from crmforms where class='process' AND code='$formName'";		
		foreach ($this->db->query($sSQL, PDO::FETCH_ASSOC) as $res)
			$_code = base64_decode($res['codedata']);
		//echo $_code;
		*/
		$c = self::pdoSQL('codedata', "select codedata from crmforms where class='process' AND code='$formName'");		
		$_code = base64_decode($c);
		
		$code = $_code ?
				str_replace(array('<@','@>'),
				array('<?php','?>'),$_code) :		
"<?php 
if (\$this->caller->status>=$status) { 
	if (\$this->caller->status==$status) {
		
		\$this->debug('$event');
	}
	return true; 
}	
return false; 
?>";
		//echo $code;
		$ret = $this->dCompile($code);

		return ($ret);
	}	
	
	protected function dCompile($data=null) {
		if (!$data) return null;
		//$data =str_replace("$","\$",$data);
		
		if (strstr($data, '?>')) {
			$data = '?>' . $data . ((substr($data, -2) == '?>') ? '<?php ' : '');
			return eval($data);				
		}
		elseif (substr($data, -8) == '/phpdac>') {
			return _m(substr($data,8,-9));
		}
		else
			return ($data);		
	}			
 
}
?>