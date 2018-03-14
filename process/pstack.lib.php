<?php
namespace Process;

class pstack {
	
	protected $debug, $db, $pMethod, $user, $seclevid;
	protected $caller, $callerName, $processName; 
	protected $pid, $clp;
	
	public function __construct(& $caller, $callerName=null, $stack=null) {
		$UserName = GetGlobal('UserName');		
		$UserSecID = GetGlobal('UserSecID');
		$this->user = decode($UserName);			
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : 
							($_SESSION['ADMINSecID'] ? $_SESSION['ADMINSecID'] :
								(((decode($UserSecID))) ? (decode($UserSecID)) : 0));		
					
		$this->debug = GetGlobal('processDebug'); //false;					
		$this->db = GetGlobal('db');
		$this->pMethod = GetGlobal('processMethod');
		
		$this->caller = $caller; //obj
		$this->callerName = get_class($caller);
		$this->processName = 'process-' . $this->callerName;		
		$this->pid = GetParam('pid');
		$this->clp = GetParam('clp');
		//echo $this->pid,'-',$this->pMethod,'>';
	}
	
	protected function stackCalc($stack=null) {
		$s = $stack ? $stack : GetGlobal('controller')->getProcessStack();		
			
		return md5(serialize($s) .'|'. $this->pMethod);
	}	
	
	protected function stackView() {
		$stack =  GetGlobal('controller')->getProcessStack(); 
		if (empty($stack)) return;
		
		$thisFile = $_SERVER['PHP_SELF']; 
		$ret = $this->pMethod . $thisFile;
		
		foreach ($stack as $caller=>$chain)	
			$ret.= '<br/>'. $caller .'->'. implode('->', $chain);
		
		return ($ret);
	}	
	
	protected function stackRegister() {
		$db = GetGlobal('db');
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return;
		
		if ($sid = $this->processRegister()) {
		
			//register stack with selected method		
			$thisFile = $_SERVER['PHP_SELF'];	
			$notes = $this->pMethod . $thisFile;			
			$cid=0;
			
			foreach ($stack as $caller=>$chain)	{
				$cid+=1; //start at 1
				$cobj = $caller;
				$cprocess = implode(',', $chain);
				$sSQL = "insert into pstack (sid,cid,cobj,cprocess,cmethod,notes) values (";
				$sSQL.= "'$sid',$cid,'$cobj','$cprocess','{$this->pMethod}','$notes')";
				$db->Execute($sSQL);
			}
			return ($cid); //stack count
		}
		return false;	
	}
	
	protected function stackIsRegistered($sid=null) {
		if (!$sid) return false;
		$db = GetGlobal('db');
		
		$cSQL = "select sid from pstack where sid='$sid' LIMIT 1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return true;	
		
		return false;
	}

	//test
	protected function findMethodFromStackId($sid=null) {
		if (!$sid) return false;
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return false;		
		
		$methods = array('serialized','balanced','puzzled');
		foreach ($method as $m) {
			$testSid = md5(serialize($stack) .'|'. $m);
			if ($testSid==$sid)
				return $m;
		}
		return null;
	}		
	
	protected function stackRun() {
		$db = GetGlobal('db');
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return false;
						
		$sid = md5(serialize($stack) .'|'. $this->pMethod);
		
		if (($this->processisActive($sid)) && 
			($this->stackIsRegistered($sid))) {
				
			$rid = md5($sid . '|' . time());
				
			//put initial record indicates stack running id
			if ($this->_stackInit($rid, $sid)) {
		
				//sendmail
				$mailbody = $this->getPageLink($rid,false,$pname);
				$subject = $pname. ':'. $rid;
				$this->mailto('sales@stereobit.gr','b.alexiou@stereobit.gr',$subject,$mailbody);		
				
				return ($rid);
			}
		}

		return false;	
	}
	
	//put initial record indicates stack inst is running
	private function _stackInit($rid, $sid) {
		$db = GetGlobal('db');
		if ((!$rid) || (!$sid)) return false;
		
		$sSQL = "insert into pstackrun (rid,sid,puser) values (";
		$sSQL.= "'$rid','$sid','{$this->user}')";
		$db->Execute($sSQL);
		
		return ($db->Affected_Rows()) ? true : false;		
	}
	
	//update running stack step
	protected function stackRunSave($state, $stackid, $chainid) {
		$db = GetGlobal('db');
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return false;		

		if ($this->isRunningProcess()) {
					
			if (!$rid = $this->pid) return false; //not an run id
			$sid = md5(serialize($stack) .'|'. $this->pMethod);		
				
			//has form / post ?
			$fn = $this->callerName .'.'. $this->getProcessById($stackid, $chainid);
			if ($this->hasForm($fn)) {
				
				//echo '__FORM__' . $fn;	
				if ((!empty($_POST)) && ($_POST['pname'] == $fn)) {
				  
					if (!$this->_stackRunIsSaved($state, $rid, $sid, $stackid, $chainid)) {				
						//put step record
						$this->_stackRunSave($state, $rid, $sid, $stackid, $chainid);
					}				  
				
					if (!$this->_stackPostIsSaved($rid, $sid, $stackid, $chainid)) {
						//put post record 
						$this->_stackPostSave($state, $rid, $sid, $stackid, $chainid);
					
						//when submit check for closed stack after post
						$ret = $this->isClosedStack();				
						return ($ret);					
					}
					//echo '__REPOST__';
					return false;
				}	
			}	
			else { //no form, no post
				
				if (!$this->_stackRunIsSaved($state, $rid, $sid, $stackid, $chainid)) {				
				
					//put step record
					$this->_stackRunSave($state, $rid, $sid, $stackid, $chainid);
				}				
			
				//echo '__NOFORM__';
				$ret = $this->isClosedStack(); 	
				
				return ($ret);
			}
			//return false;
		}
		return false;
	}	
	
	private function _stackPostSave($state, $rid, $sid, $stackid, $chainid) {
		$db = GetGlobal('db');		

		$pdata = json_encode($_POST); //addslashes(json_encode($_POST));
		$pSQL = "insert into pstackpoint (rid,sid,sstep,pstep,pstate,pobj,puser,pdata) values (";
		$pSQL.= "'$rid','$sid','$stackid','$chainid','$state','{$this->callerName}','{$this->user}','$pdata')";
		//echo $pSQL;
		$db->Execute($pSQL);	
		
		return ($db->Affected_Rows()) ? true : false;
	}	
	
	private function _stackRunSave($state, $rid, $sid, $stackid, $chainid) {
		$db = GetGlobal('db');		

		$sSQL = "insert into pstackrun (rid,sid,sstep,pstep,pstate,pobj,puser) values (";
		$sSQL.= "'$rid','$sid','$stackid','$chainid','$state','{$this->callerName}','{$this->user}')";
		$db->Execute($sSQL);
		//echo $sSQL;
		$res = $db->Execute($sSQL);		
		
		return ($db->Affected_Rows()) ? true : false;
	}	
	
	//not to rewrite in db
	private function _stackRunIsSaved($state, $rid, $sid, $stackid, $chainid) {
		$db = GetGlobal('db');		

		$sSQL = "select rid from pstackrun ";
		$sSQL.= "where rid='$rid' and sid='$sid' and sstep=$stackid and pstep=$chainid ";
		$sSQL.= "and pstate=$state and pobj='{$this->callerName}' and puser='{$this->user}'";
		//echo $sSQL;
		$res = $db->Execute($sSQL);		
		
		return ($res->fields[0]) ? true : false;
	}
	
	//not to rewrite in db
	private function _stackPostIsSaved($rid, $sid, $stackid, $chainid) {
		$db = GetGlobal('db');	
		
		$sSQL = "select rid from pstackpoint ";
		$sSQL.= "where rid='$rid' and sid='$sid' and sstep=$stackid and pstep=$chainid ";
		$sSQL.= "and pobj='{$this->callerName}' and puser='{$this->user}'";
		//echo $sSQL;
		$res = $db->Execute($sSQL);		
		
		return ($res->fields[0]) ? true : false;
	}	

	protected function stackPost($data=false, $stackid, $chainid, $caller=null) {
		$db = GetGlobal('db');
		$df = $data ? 'pdata' : 'rid';
		$obj = $caller ? $caller : $this->callerName;	

		//return process post
		$cSQL = "select $df from pstackpoint where rid='{$this->pid}' and sstep=$stackid and pstep=$chainid and pobj='$obj' LIMIT 1";
		$res = $db->Execute($cSQL);
		//echo $cSQL .'>'. $res->fields[0];;
		if ($res->fields[0]) 
			return ($res->fields[0]);

		return false; 				
	}			
	
	//check all stack records
	protected function isClosedStack() {
		$db = GetGlobal('db');		
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return false;		
		
		if (!$rid = $this->pid) return false; //not a run id
		$sid = md5(serialize($stack) .'|'. $this->pMethod);
		
		if ($this->isRunningProcess())  {
			$stackid = 1;
			foreach ($stack as $caller=>$chain)	{

				$sName = $this->getCallerNameInStack($caller);
				foreach ($chain as $p=>$process) {
					$chainid = $p+1; //inc by 1
					if (!$this->_stackProcessFinished($rid, $sid, $stackid, $chainid, $sName)) 
						return false;
				}
				$stackid+=1;
			}
			
			//put end record
			if ($this->_stackFinish($rid, $sid)) {
			
				//sendmail to process owner
				$this->processMail($rid .' is closed', $this->showProcess(null,99), true);
			
				//fire-up another instance (repeat)
				if ($rid = $this->stackRun()) {
					//do something
				}
			
				return true;
			}
		}
		
		return false;	
	}	
	
	private function _stackProcessFinished($rid, $sid, $stackid, $chainid, $obj) {
		$db = GetGlobal('db');
		if ((!$rid) || (!$sid)) return false;		
		
		$sSQL = "select rid from pstackrun where rid='$rid' and sid='$sid' ";
		$sSQL.= "and sstep=$stackid and pstep=$chainid and pstate=1 and pobj='$obj'";
		//echo '<br/>',$sSQL;
		$res = $db->Execute($sSQL);	

		if ($res->fields[0]) 
			return true;

		return false;	
	}
	
	//update init record indicates stack inst is finished 
	private function _stackFinish($rid, $sid) {
		$db = GetGlobal('db');
		if ((!$rid) || (!$sid)) return false;
		
		$sSQL = "update pstackrun set pstate=1 where pobj IS NULL AND rid='$rid' AND sid='$sid'";
		$db->Execute($sSQL);
		
		return ($db->Affected_Rows()) ? true : false;		
	}	
	
	protected function setFormStack($form=null) {
		global $fs;
		
		$fs[] = $form;

		return true;
	}
	
	protected function getFormStack() {
		global $fs;
		if (empty($fs)) return null;

		foreach ($fs as $form) {	
			//echo $form . '<br/>';
			$ret .= $this->loadForm($form);
		}	
			
		return ($ret);
	}	
	
	
	
	
	//process
	
	protected function getProcessName() {
		return $this->processName;
	}	
	
	protected function getProcessStepName() {
		return $this->processStepName;
	}		
	
	//method serialized
	//return array of process,call object,user,state	
	protected function getProcessStep() {
		$db = GetGlobal('db');	
	
		if ($this->isRunningProcess())  {
			//fetch last run process record
			$pSQL = "select sstep,pstep,pobj,puser,pstate from pstackrun where rid='{$this->pid}' order by id DESC LIMIT 1";
			//and pobj='{$this->callerName}' 
			$res = $db->Execute($pSQL);
			if (($stackid = $res->fields[0]) && ($chainid = $res->fields[1])) {
				echo 'a:',$stackid,':',$chainid;
				$ret = array($this->getNextProcessById($stackid, $chainid),
							 $this->getNextCallerById($stackid, $chainid),
							 $res->fields[3],
							 $res->fields[4]);	
				return ($ret);
			}	
			//else rec field IS NULL but running 
			//fetch first step
			echo 'b:';
			$ret = array($this->getProcessById(),
						$this->getCallerById(),
						null,
						null);	
			return ($ret);
		}
		//or not running (rec is not exist)
		//echo 'c';
		return array();//false; 		
	}	

	protected function isRunningProcess() {
		$db = GetGlobal('db');	

		//check if id is a running process
		$cSQL = "select rid from pstackrun where rid='{$this->pid}' and pobj IS NULL AND (pstate IS NULL OR pstate=0) LIMIT 1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return ($res->fields[0]);
		
		return false; 			
	}	

	protected function isClosedProcess($pid=null) {
		$db = GetGlobal('db');	
		$rid = $pid ? $pid : $this->pid;
	
		//check if id is an ended process
		$cSQL = "select rid from pstackrun where pobj IS NULL AND pstate=1 AND rid='$rid' LIMIT 1";
		
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return ($res->fields[0]);

		return false; 	
	}		

	protected function showProcess($pid=null,$limit=1) {
		$db = GetGlobal('db');	
		$rid = $pid ? $pid : $this->pid;
	
		//fetch last running process record
		$pSQL = "select datein,sid,sstep,pstep,pstate,pobj,puser from pstackrun where rid='$rid' order by id DESC LIMIT $limit";
		$res = $db->Execute($pSQL);
		
		foreach ($res as $i=>$rec) {
			
			if ($this->isProcessUser($rec[6])) {
				$ret.= "date:" . date('d-m-Y h:i:s',strtotime($rec[0])) . '<br/>';
				$ret.= "sid:" . $rec[1] . '<br/>';
				$ret.= "sstep:" . $rec[2] . '<br/>';
				$ret.= "pstep:" . $rec[3] . ' (' . $this->getProcessById($rec[2], $rec[3]) . ')<br/>';
				$ret.= "pstate:" . $rec[4] . '<br/>';
				$ret.= "pobj:" . $rec[5] . '<br/>';
				$ret.= "puser:" . $rec[6] . '<br/>';
				$ret.= "pdata:" . $this->stackPost(true,$rec[2],$rec[3],$rec[5]) . '<br/><hr/>';
			}
			else
				$ret.= "another user<br/><hr/>";
		}	
		
		return ($ret); 		
	}	
	
	protected function showOpenProcess() {
		$db = GetGlobal('db');	
			
		//fetch open running process record
		$pSQL = "select datein,rid,sid,sstep,pstep,pstate,pobj,puser from pstackrun ";
		$pSQL.= "where pobj IS NULL AND (pstate IS NULL OR pstate=0) "; 
		$pSQL.= "AND puser='{$this->user}' order by id DESC";
		$res = $db->Execute($pSQL);
		//echo $pSQL;
		
		foreach ($res as $i=>$rec) {
			$ret.= "date:" . date('d-m-Y h:i:s',strtotime($rec[0])) . '<br/>';
			$ret.= "rid:" . $rec[1] . '<br/>';			
			$ret.= "sid:" . $rec[2] . '<br/>';
			/*$ret.= "sstep:" . $rec[3] . '<br/>';
			$ret.= "pstep:" . $rec[4] . ' (' . $this->getProcessById($rec[2], $rec[3]) . ')<br/>';
			$ret.= "pstate:" . $rec[5] . '<br/>';
			$ret.= "pobj:" . $rec[6] . '<br/>';*/
			$ret.= "puser:" . $rec[7] . '<br/><hr/>';
		}	
		
		return ($ret); 		
	}	
	
	protected function showClosedProcess() {
		$db = GetGlobal('db');	
	
		//fetch closed process record
		$pSQL = "select datein,rid,sid,sstep,pstep,pstate,pobj,puser from pstackrun ";
		$pSQL.= "where pobj IS NULL AND pstate=1 ";	
		$pSQL.= "AND puser='{$this->user}' order by datein DESC";
		$res = $db->Execute($pSQL);
		//echo $pSQL;
		
		foreach ($res as $i=>$rec) {
			$ret.= "date:" . date('d-m-Y h:i:s',strtotime($rec[0])) . '<br/>';
			$ret.= "rid:" . $rec[1] . '<br/>';			
			$ret.= "sid:" . $rec[2] . '<br/>';
			/*$ret.= "sstep:" . $rec[3] . '<br/>';
			$ret.= "pstep:" . $rec[4] . ' (' . $this->getProcessById($rec[2], $rec[3]) . ')<br/>';
			$ret.= "pstate:" . $rec[5] . '<br/>';
			$ret.= "pobj:" . $rec[6] . '<br/>';*/
			$ret.= "puser:" . $rec[7] . '<br/><hr/>';
		}	
		
		return ($ret); 		
	}	
	
	protected function processRegister() {
		$db = GetGlobal('db');
		$stack =  GetGlobal('controller')->getProcessStack();
		if (empty($stack)) return false;
		
		$thisFile = $_SERVER['PHP_SELF'];	
		$sid = md5(serialize($stack) .'|'. $this->pMethod);
		
		//check if process exist
		$cSQL = "select sid from process where sid='$sid' LIMIT 1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) return false; //process exist
		
		$sSQL = "insert into process (sid,active,method,notes) values (";
		$sSQL.= "'$sid',1,'{$this->pMethod}','$thisFile')";
		$db->Execute($sSQL);

		return ($sid); 
	}	
	
	protected function processExist($sid=null) {
		if (!$sid) return false;
		$db = GetGlobal('db');
		
		$cSQL = "select sid from process where sid='$sid' LIMIT 1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return true;	
		
		return false;
	}	
	
	protected function processStatus($state, $rid, $sid, $stackid, $chainid) {
		
		if (!$this->_stackRunIsSaved($state, $rid, $sid, $stackid, $chainid)) 
			return ($state);	
				
		return false;		
	}
	
	protected function processIsActive($sid=null) {
		if (!$sid) return false;
		$db = GetGlobal('db');
		
		$cSQL = "select sid from process where sid='$sid' and active=1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return true;	
		
		return false;
	}	
		
	
	protected function getProcessById($stackid=1, $chainid=1) {
		$stack = (array) GetGlobal('controller')->getProcessStack();
		$sid = 0;
		$cid = 0;
		foreach ($stack as $stackName=>$processChain) {
			if ($sid==$stackid-1) {
				foreach ($processChain as $process) {
					if ($cid==$chainid-1)
						return $process;
					$cid+=1;
				}
			}
			$sid+=1;
		}
		
		return false;		
	}
	
	protected function getNextProcessById($stackid=1, $chainid=1) {
		$stack = (array) GetGlobal('controller')->getProcessStack();
		$sid = 0;
		$cid = 0;
		foreach ($stack as $stackName=>$processChain) {
			if ($sid==$stackid-1) {
				if ($ret = $processChain[$chainid]) //=+1 without -
					return ($ret);		
			}
			elseif ($sid==$stackid) {
				$ret = $processChain[0];
				break;
			}	
			$sid+=1;
		}
		//break..
		return $ret;		
	}

	protected function getNextCallerById($stackid=1, $chainid=1) {
		$stack = (array) GetGlobal('controller')->getProcessStack();
		$sid = 0;
		$cid = 0;
		foreach ($stack as $stackName=>$processChain) {
			if ($sid==$stackid-1) { //same caller
				if ($processChain[$chainid]) //=+1 without -
					return ($this->getCallerNameInStack($stackName));		
			}
			elseif ($sid==$stackid) { //next stack caller
				$ret = $this->getCallerNameInStack($stackName);
				break;
			}	
			$sid+=1;
		}
		//break..
		return $ret;		
	}	
	
	protected function getCallerById($stackid=1) {
		$stack = (array) GetGlobal('controller')->getProcessStack();
		$sid = 0;
		foreach ($stack as $stackName=>$processChain) {
			if ($sid==$stackid-1) {
				return $this->getCallerNameInStack($stackName);
			}
			$sid+=1;
		}
		
		return false;		
	}	
		
	protected function getProcessChain() {
		$stack = (array) GetGlobal('controller')->getProcessStack();
		
		foreach ($stack as $stackName=>$processChain) {
			$sName = $this->getCallerNameInStack($stackName);
			if ($sName == $this->callerName) 
				return (array) $processChain;
		}
		
		return null;
	}		
	
	//get the .part of dpc name
 	protected function getCallerNameInStack($stackElement=null) {
		if (!$stackElement) return null;
		
		$n = explode('.', $stackElement);
		return array_pop($n);
	}			
	
	//get the fire-up user
	protected function getProcessOwner() {
		$db = GetGlobal('db');	

		//check if there is startup running record
		$cSQL = "select puser from pstackrun where pobj IS NULL AND rid='{$this->pid}' LIMIT 1";
		$res = $db->Execute($cSQL);
		if ($res->fields[0]) 
			return ($res->fields[0]);
		
		return false; 
	}	
	
	protected function getProcessUsers() {
		$db = GetGlobal('db');	
		
		$cSQL = "select email from ulist where listname='{$this->processStepName}'";
		$res = $db->Execute($cSQL);
		foreach ($res as $i=>$rec) 
			$u[] = $rec[0];
			
		return (array) $u;	
	}	

	//get the users included in ulist named as process step name
	protected function isProcessUser($user=null) {
		$db = GetGlobal('db');	
		$u = $user ? $user : $this->user;
		//test
		return 'vasalex21@gmail.com';
		
		if (!filter_var($u, FILTER_VALIDATE_EMAIL))
			return false;

		$cSQL = "select email from ulists where listname='{$this->processStepName}'";
		$res = $db->Execute($cSQL);
		
		foreach ($res as $i=>$rec) {
			if (strstr($u, $rec[0])==0)
				return true;
		}
		
		return false; 
	}	
	
	//ulist named as process mail send
	protected function processMail($subj=null, $body=null, $to=false) {	
		//$db = GetGlobal('db');	
		$rid = $this->pid;
		$from = 'sales@stereobit.gr';
		$mailbody = $body ? $body : $this->getPageLink($rid,false,$pname);		
		$subject = $subj ? $subj : $pname .':'. $rid; 
		
		if ($to) {
			if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
				$toProcessOwner = $this->getProcessOwner();
				$err = $this->mailto($from,$toProcessOwner,$subject,$mailbody);
			}
			else	
				$err = $this->mailto($from,$to,$subject,$mailbody);
		}
		//else
			
		//check if mails exist for the process as ulist step name
		/*$cSQL = "select email from ulist where listname='{$this->processStepName}'";
		$res = $db->Execute($cSQL);
		
		foreach ($res as $i=>$rec) {
			//sendmail
			$err.= $this->mailto($from,$rec[0],$subject,$mailbody);
		}*/
		foreach($this->getProcessUsers() as $u=>$puser)
			$err.= $this->mailto($from,$puser,$subject,$mailbody);

		return (!$err) ? true : false; 	
	}	
	
	//misc		
	
	protected function isLevelUser($level=1) {
		return ($this->seclevid >= $level) ? true : false;
	}

	protected function hasForm($formName=null) {
		$db = GetGlobal('db');		
		if (!$formName) return null;

		//if (defined('CRMFORMS_DPC')) {
			$sSQL = "select code from crmforms where class='process' AND code=" . $db->qstr($formName);
			//echo $sSQL;
			$res = $db->Execute($sSQL);			
			$ret = $res->fields[0];			
		//}
		return ($ret ? true : false);
	}	
	
	protected function loadForm($formName=null) {
		$db = GetGlobal('db');		
		if (!$formName) return null;

		//if (defined('CRMFORMS_DPC')) {
			$sSQL = "select formdata from crmforms where class='process' AND code=" . $db->qstr($formName);
			//echo $sSQL;
			$res = $db->Execute($sSQL);			
			$ret = base64_decode($res->fields['formdata']);			
		/*}
		elseif (defined('CMSRT_DPC')) {
			$ret = 'Load form:' . $formName;
			if (!$f = _m("cmsrt.select_template use $formName+1+p")) {
				//generic form without caller name
				$fn = explode('.', $formName);
				$f = _m("cmsrt.select_template use ". $fn[1] ."+1+p");
				$ret.= '/' . $fn[1];
			}
			$ret.= $f;
		}*/
		//else
			//$ret = 'CMS form required:' . $formName;

		return str_replace(array('__PID__', '__PROCESSNAME__'),
						   array(GetParam('pid'), $formName), 
							$ret);
		//return $f;
	}	
	
	protected function loadLoginForm($event=null) {

		if (defined('CMSRT_DPC')) {
			//$ret = 'Load form:login';
			//$ret.= _m("cmsrt.select_template use login+1"); //cp path
			$tokens[] = GetGlobal('sFormErr');
			$ret.= _m('cmsrt._ct use qlogin+' . serialize($tokens));
		}
		else
			$ret = 'CMS form required:' . $formName;
		
		return $ret;
	}

	protected function mailto($from=null,$to=null,$subject=null,$body=null) {

		if (defined('CMSRT_DPC')) {

			$err = _m("cmsrt.cmsmail use $from+$to+$subject+$body");
			return true;
		}
		elseif (defined('SMTPMAIL_DPC')) { 
		
	        $smtpm = new smtpmail;
		   
		    $smtpm->to($to); 
		    $smtpm->from($from); 
		    $smtpm->subject($subject);
		    $smtpm->body($body);	
			
			$err = $smtpm->smtpsend();		
			
			return true;
		}	
		
		return false;
	}	
 
	protected function _write($data=null) {
   
		if (!$length = strlen($data)) 
			return false;
 
		if ($fp = fopen($this->processName . '.txt.php', "w")) {	
			$bytes = fwrite($fp, $data, $length);
			fclose($fp);	   
			return ($bytes);
		}

		return false; 
	}
 
	protected function _writeutf8($data=null) {
   
		if (!$length = strlen($data)) 
			return false;
	
		if ($fp = fopen($this->processName . '.txt.php', "wb")) {	
	
			fwrite($fp, pack("CCC",0xef,0xbb,0xbf)); 
			$bytes = fwrite($fp, $data, $length);
			fclose($fp);	   
			return ($bytes);
		}

		return false; 
	} 

 
	protected function write2disk($data=null) {

        if ($fp = @fopen ($this->processName . '.txt.php', "a+")) {

            fwrite ($fp, $data);
            fclose ($fp);

            return true;
        }
        
        echo "File creation error ({$this->processName})!<br/>";
        return false;
	} 	

	protected function getPageLink($rid=null, $url=false, &$processName=null) {
		$httpurl = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';
		$httpurl.= (strstr($_SERVER['HTTP_HOST'], 'www')) ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];		
		$u = $url ? $url : $httpurl;//"http://www.stereobit.gr/";
		$n = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);
		$p = explode('.', $n);
		
		if (strstr($p[0],'_')) {
			$pn = explode('_', $p[0]);
			$processName = localize($pn[1], getlocal());
			
			$link = $u . '/p/'. $pn[1] .'/';
			$link.= $rid ? $rid .'/' : null;
			return $link;
		}
		
		$processName = localize(array_shift($p), getlocal());
		$link = $u . '/process/';
		$link.= $rid ? $rid .'/' : null;		
		
		return ($link); 
 	}
	
	protected function getPageProcessName($rid=null, $url=false) {
		$u = $url ? $url : "http://www.stereobit.gr/";
		$n = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);
		$p = explode('.', $n);
		
		if (strstr($p[0],'_')) 
			return localize($pn[1], getlocal());
			
		return localize(array_shift($p), getlocal());
 	}	
}
?>