<?php

class processInst {
	
	protected $processStepName, $processChain;
	protected $stack, $chain, $event, $caller, $env; 		
	
	public function __construct(& $caller, $callerName=null, $chain=null) {
				
		$this->caller = $caller; //process class
		$this->env = $caller->env; //process env (proc for srv tier for client)	
				
		$this->event = $caller->event;
		$this->stack = $caller->getProcessStack();//(array) $stack; //get env chain
		$this->chain = (array) $chain;; //$caller->getProcessChain();
	}	
	
	//include -remote- file (return string to require/require_once)
	protected function _include($inc) {
		//echo $this->env->ldscheme . '<<<<<<<<<<<<<' . $inc . PHP_EOL;
		$phpdac = isset($this->env->ldscheme) ? 
						$this->env->ldscheme .'/' : null;	
						
		return ($phpdac . $inc);
	}	
	
	//loader (any new object inside processes use vendor/dir)	
	//usage $this->loader('vendor/messages/') //vendor dir	
	//https://stackoverflow.com/questions/37842573/php-spl-autoload-register-pass-second-parameter	
    protected function loader($vendor=null) {
	
	    //echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n"; 
		spl_autoload_register(function($className) use ($vendor) 
		{
			try {
				//include($this->_include($vendor . str_replace(array('\\', "\0"), array('/', ''), $className) . '.php'));
				@include_once($this->_include($vendor . str_replace(array('\\', "\0"), array('/', ''), $className) . '.php'));
				//echo "File {$vendor}{$className} loaded!";
			}
			catch (Throwable $t) {
				//echo $t . PHP_EOL;
				echo $className  . ' NOT found!' . PHP_EOL;
			}
		}); 
    }	

	//ETL make (decoration pattern)	
	public function runETL($_stack) {
		if (empty($_stack)) return false;
		//$_stack = $this->stack['kernel'];
		//array_shift($_stack); //exclude 1st elm, 'async' call ()		
		//print_r($_stack);
		
		reset($_stack);		
		foreach ($_stack as $i=>$pInst) {
			$cc[] = "new $pInst(";
		}
		$zcmd = implode('', $cc) . str_repeat(')', count($_stack)) . ';';
		echo 'Run ETL command: ' . $zcmd;// . PHP_EOL;
			
		try {
			eval("\$etl = " . $zcmd);
		} 
		catch (Throwable $t) {
			echo $t . PHP_EOL;
			return false;
		}		
		
		return ($etl);
	}	
	
	protected function go() {
		
		return true;
	}	
	
	
	//////////////////////////////////////////////
	// interopt methods with process stack
	//////////////////////////////////////////////
	
	public function isFinished($event=null, $data=null) {
		if (!$this->caller->isProcessUser()) 
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
		$pid = $this->caller->isRunningProcess();	
		$isClosed = $this->caller->isClosedProcess();
		
		$fn = $this->caller->callerName .'.'. $this->processStepName;
		$pForm = $this->caller->hasForm($fn) ? $fn : null;		
		$pData = $this->caller->stackPost(true, $stackId, $chainId);
		//$pData = $this->caller->setPost(false, $stackId, $chainId);
		
		$sid = md5(serialize($this->stack) .'|'. $this->caller->pMethod);
		$pRunStatus = $this->caller->processStatus(1, $pid, $sid, $stackId, $chainId);

		$c = array( 'name'=>$this->processStepName,
					'process'=>$this->caller->processName,
					'caller'=>$this->caller->callerName,
					'event'=>$this->event,	
					'method'=>$this->caller->pMethod,
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

		$thisID = $this->getChainId()-1; 
		//print_r($chain); echo $thisID;
		return $this->chain[$thisID+1]; 
	}

	protected function getPrevInChain() {

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
		
		return @count($this->chain);
	}	
	
	protected function getChainId() {

		if (empty($this->chain)) return 0;
		
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
				$sName = $this->caller->getCallerNameInStack($stackName);
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
				$sName = $this->caller->getCallerNameInStack($stackName);
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
			
			$sName = $this->caller->getCallerNameInStack($stackName);
			//echo $stackName , '>' , $sName;
			if ($sName == $this->callerName)
				return ($id + 1);
		}
		
		return 0;
	}	
	
	//update running stack step
	protected function stackRunStep($state=null) {	
	
		if ($this->caller->isRunningProcess())  {
			
			$cid = $this->getChainId();
			$sid = $this->getStackId();
			$pstate = $state ? 1 : 0;	
		
			$final = $this->caller->stackRunSave($pstate, $sid, $cid);
			if (!$final)		
				$this->setFormStack();
			
			return true;//($ret);
		}	
		
		return false;
	}
	
	//return post data else rid
	protected function stackPostStep($data=false) {

		if ($this->caller->isRunningProcess())  {		

			$cid = $this->getChainId();
			$sid = $this->getStackId();
			//echo $cid . ':' . $sid;
			
			//check if process has post
			$ret = $this->caller->stackPost($data, $sid, $cid);
			return ($ret);
		}
		return false; 				
	}	
	
	//override
	protected function setFormStack($form=null) {
		$f = $form ? $form : $this->callerName .'.'. $this->caller->processStepName;

		if (!$this->stackPostStep()) 	
			return $this->caller->setFormStack($f);	

		return false;
	}	
	
	//misc	
	
	protected function debug($event=null) {
		
		if ($this->caller->debug) {
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
		$formName = $this->callerName .'.'. $this->caller->processStepName;// . ($event ? '.'.$event : null);
		
		//crm forms
		$sSQL = "select codedata from crmforms where class='process' AND code='$formName'";		
		$c = $this->env->pdoQuery($sSQL);
		
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