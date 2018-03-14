<?php
$__DPCSEC['CMSAGENT_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if (!defined("CMSAGENT_DPC")) {
define("CMSAGENT_DPC",true);

$__DPC['CMSAGENT_DPC'] = 'cmsagent';

$a = GetGlobal('controller')->require_dpc('cms/cmsagent.dpc.php');
require_once($a);
 
$__EVENTS['CMSAGENT_DPC'][0]='cmsagent';
$__EVENTS['CMSAGENT_DPC'][1]='jsdcode';
$__EVENTS['CMSAGENT_DPC'][2]='jsdecode';

$__ACTIONS['CMSAGENT_DPC'][0]='cmsagent';
$__ACTIONS['CMSAGENT_DPC'][1]='jsdcode';
$__ACTIONS['CMSAGENT_DPC'][2]='jsdecode';

$__DPCATTR['CMSAGENT_DPC']['cmsagent'] = 'cmsagent,1,0,0,0,0,0,0,0,1,1,1,1';

$__LOCALE['CMSAGENT_DPC'][0]='CMSAGENT_DPC;Agent;Agent';

class cmsagent {
   
    protected $ip, $ipx, $useragent, $referer, $sesViewItems;
	protected $currentDiv, $currentPage, $currentItem, $currentCat;
	protected $menus, $searches, $filters, $actions, $events, $pages;
	protected $cartin, $cartout, $checkout, $items, $categories;
	protected $msgId, $pastMsg;
   
	public function __construct() {
		
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->ipx = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$this->useragent = $_SERVER['HTTP_USER_AGENT'];	
		
		//as saved at rcvstats
		$this->referer = $_SESSION['http_referer'] ? $_SESSION['http_referer'] : $_SERVER['HTTP_REFERER'];
		//items viewed in session (array)
		$this->sesViewItems = unserialize(GetSessionParam('lastvieweditems'));
	
		$this->currentDiv = GetReq('div'); //as came from url call
		$this->currentPage = GetReq('uri'); //as came from url call
		$this->currentItem = GetReq('id'); //as came from url call
		$this->currentCat = GetReq('cat'); //as came from url call		
		
		$this->msgId = $this->currentItem ? $this->currentItem : 
						($this->currentCat ? $this->currentCat : $this->currentPage);	
	
		//load shown messages to not replay 
		$this->pastMsg = GetSessionParam('_PASTMSG');

		//init arrays
		$this->menus = $this->searches = $this->filters  = $this->actions = $this->events = $this->pages = array();
		$this->cartin = $this->cartout = $this->checkout = $this->items = $this->categories = array();		
	}
   
	public function event($event=null) {
		
		if ($this->isBot()) die();

		switch ($event) {
			case 'jsdecode' :   //url to see session agent data
								die($this->sessionDecode());
								
            case 'jsdcode'  :   //as call from ajax url
								//$this->getHistory(); //disabled in this
								break;
								
			default 		: 	
		}
	}
   
	public function action($action=null) {

		return null;
	}
	
	protected function sessionDecode() {
		
		print_r($this->pastMsg);
		die();
	}

	protected function isLoadedMessage() {
		
		foreach ($this->pastMsg as $mid=>$divid) {
			if (($mid == $this->msgId) && ($divid == $this->currentDiv)) 
				return true;
		}	
		
		return false;
	}	
	
	//save showed messages to not replay
	//(endpage msg of id replace div msg id, review div msg if endpage)	
	protected function saveMessage() {
	
		$this->pastMsg[$this->msgId] = $this->currentDiv;
		SetSessionParam('_PASTMSG', $this->pastMsg);

		return true;	
	}
	
	protected function showMessage($msg=null) {
		if ($msg)
			return _m("jsdialogStream.say use $msg+++2000");
		
		return null;
	}	
	
	public function respond() {
		if ($this->isBot()) return null;
		if ($this->isLoadedMessage()) return null;
		$respond = null;		
		
		if ($this->currentItem) { //search for item agent
			//$aSQL = "SELECT script from pagents ";
			//$aSQL.= "where code=" . $db->qstr($currentItem);
			//$res = $db->Execute($aSQL);
			//if ($res->fields[0]) {
				//load agent
				//..
				//switch ($this->currentDiv)
			//}	
			$d =  date('Y-m-d H:i:s');
		}
		elseif ($this->currentCategory) { //category instructions
			//switch ($this->currentDiv)
			$d =  date('H:i:s');
		}
		elseif ($this->currentPage) { //page instructions
			//switch ($this->currentDiv)
			$d =  date('Y-m-d');
		}
		else { //default instructions
			//switch ($this->currentDiv)
	
			if (stristr($this->referer, 'skroutz'))
				$d = date('d-m-Y H:i:s'); 
			elseif (stristr($this->referer, 'bestprice'))
				$d = date('d-m-Y H:i:s'); 
			else
				$d = /*$this->referer ? urldecode($this->referer) :*/ date('H:i:s');
		
			//$d =  date('Y-m-d H:i:s');
		}		
		
		if ($d) {
			$this->saveMessage();
			$respond = $this->showMessage($d);
		}
		
		return ($respond);
	}
	
	protected function getHistory($save=false, $daysback=null) {		
		if (($save==true) && ($history = GetSessionParam('_AGNHIST')))
			return (unserialize($history));
	
		$db = GetGlobal('db'); 	
		$user = GetGlobal('UserName') ? decode(GetGlobal('UserName')) : null;	
		
		//can be based on ip and date before today		
		$sSQL = "SELECT tid,attr1,REMOTE_ADDR,HTTP_USER_AGENT,REFERER from stats where ";
		$sSQL.= $user ? " attr2=" . $db->qstr($user) . ' OR attr3=' . $db->qstr($user) : 
					    " attr2=" . $db->qstr(session_id());
		$sSQL.= $daysback ? " and DATE(date) BETWEEN DATE( DATE_SUB( NOW() , INTERVAL $daysback DAY ) )" : null;					
		$sSQL.= " ORDER BY DATE DESC LIMIT 100";
		$res = $db->Execute($sSQL); 
	
		if (!empty($res->fields)) {
			//fetch items, categories...
			foreach	($res as $i=>$rec) {
				if ($tid = $rec[0]) { 
					switch ($tid) {
						case 'menu'    : $this->menus[] = $rec[1]; break;
						case 'search'  : $this->searches[] = $rec[1]; break;
						case 'filter'  : $this->filters[] = $rec[1]; break;
						case 'action'  : $this->actions[] = $rec[1]; break;
						case 'event'   : $this->events[] = $rec[1]; break;					
						case 'fp'      : $this->pages[] = $rec[1]; break;
						case 'template': break;					
						default        : if (!$rec[1]) 
											$this->items[] = $tid; 
					}		
				}	
				if ($attr1 = $rec[1]) {
					switch ($attr1) {
						case 'cartin'  : $this->cartin[] = $rec[0]; break;
						case 'cartout' : $this->cartout[] = $rec[0]; break;
						case 'checkout': $this->checkout[] = $rec[0];break;			
						default        : if (!$rec[0]) 
											$this->categories[] = $attr1;
					}		
				}	
			}
		}
		
		
		$story = array('menus'=>$this->menus, 
						'searches'=>$this->searches, 
						'filters'=>$this->filters,
						'actions'=>$this->actions, 
						'events'=>$this->events,
						'pages'=>$this->pages,
						'items'=>$this->items,
						'categories'=>$this->categories,
						'cartin'=>$this->cartin,
						'cartout'=>$this->cartout,
						'checkout'=>$this->checkout,
						'user'=>array($user, $rec['REMOTE_ADDR'], $rec['HTTP_USER_AGENT'], $rec['REFERER'])
					  );
						  
		if ($save==true)  //save in ses
			SetSessionParam('_AGNHIST', serialize($story));

		return ($story);	
	}	
	

	public function isBot($a=null) {
		$agent = $a ? $a : $this->useragent;
		$avoiduseragent = _m("cms.arrayload use CMS+httpUserAgentsToAvoid");
		
		if (!empty($avoiduseragent)) {
			foreach ($avoiduseragent as $i=>$ua) {
				if (stristr($agent, $ua)) 
					return true;
			}
		}
		
		return false;	
	}	
   
};
}
?>