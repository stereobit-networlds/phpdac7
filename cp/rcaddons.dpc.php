<?php

$__DPCSEC['RCADDONS_DPC']='1;1;1;1;1;1;1;1;1;1;1';

if ((!defined("RCADDONS_DPC")) && (seclevel('RCADDONS_DPC',decode(GetSessionParam('UserSecID')))) ) {
define("RCADDONS_DPC",true);

$__DPC['RCADDONS_DPC'] = 'rcaddons';

$a = GetGlobal('controller')->require_dpc('libs/appkey.lib.php');
require_once($a);
 
$__EVENTS['RCADDONS_DPC'][0]='cpaddons';
$__EVENTS['RCADDONS_DPC'][1]='cpadd';

$__ACTIONS['RCADDONS_DPC'][0]='cpaddons';
$__ACTIONS['RCADDONS_DPC'][1]='cpadd';

$__DPCATTR['RCADDONS_DPC']['cpaddons'] = 'cpaddons,1,0,0,0,0,0,0,0,0,0,0,1';

$__LOCALE['RCADDONS_DPC'][0]='RCADDONS_DPC;File system;File system';

class rcaddons {

    var $title, $prpath, $post, $msg, $url;
	var $tool_path, $environment, $seclevid, $tools, $appkey;
	
	public function __construct() {
		
		$murl = arrayload('SHELL','ip');
        $this->url = $murl[0]; 		
		
	    $this->title = localize('RCADDONS_DPC',getlocal());		
		$this->post = false; 
		$this->msg = null;
		$this->prpath = paramload('SHELL','prpath');
		
		$toolp = remote_paramload('RCCONTROLPANEL','toolpath',$this->prpath);
		$this->tool_path = $toolp ? $toolp : '../../cp/'; 
		
		$awurl = remote_paramload('RCAWSTATS','file',$this->prpath);
		$this->awstats_url = $awurl ? $awurl : ((!empty($this->murl)) ? array_pop($this->murl) : str_replace('www.','',$_ENV["HTTP_HOST"]));		
		
		$this->seclevid = $GLOBALS['ADMINSecID'] ? $GLOBALS['ADMINSecID'] : $_SESSION['ADMINSecID'];		
		
		$this->appkey = new appkey();				
	}	
	 	
    public function event($event) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
  
		switch ($event) {	
							   
			case "cpaddons"		:
			default             : 	$this->set_addons_list();
									$this->environment = $_SESSION['env'] ? $_SESSION['env'] : $this->read_env_file(true);				
		}   
    }
  
    public function action($action) {
		
		$login = $GLOBALS['LOGIN'] ? $GLOBALS['LOGIN'] : $_SESSION['LOGIN'];
		if ($login!='yes') return null;	
  
		switch ($action) {	
							   
			case "cpaddons"		:
			default             : $out = null;
		}   
		return ($out);
    } 
	 
	 
	//read environment cp file
	protected function read_env_file($save_session=false) {

		$ret = _m('rcpmenu.parse_environment use ' . $save_session);	
		return ($ret);
    } 	 
	 
	//return dpc array for update
	protected function get_dpc_modules() {
		if (!_m('rccontrolpanel.isLevelUser use 9')) return false;
		
	    //read priv dpc dir
		//compare with root dir
		//return array of newer
		$dirname = $this->urlpath . '/cgi-bin/shop/';
		$diffdir = $this->prpath . $this->tool_path . 'upgrade-app/cgi-bin/shop/';
		
		if (is_dir($dirname)) {
			$mydir = dir($dirname);
			while ($fileread = $mydir->read ()) {
				if (($fileread!='.') && ($fileread!='..') && (!is_dir($fileread)))  {
				
				    $sourcetime = @filemtime($dirname.$fileread);
					$targettime = @filemtime($diffdir.$fileread);
					
					if ((is_readable($diffdir.$fileread)) && 
					    ($sourcetime<$targettime)) {
						
						$datemod = date('Y-m-d H:i', $targettime);
						$ret[$fileread] = str_replace('.php','.mod',$fileread) .
						                  '&nbsp;' . localize('_modified',getlocal()) . 
						                  '&nbsp;' . $this->appkey->nicetime($datemod, localize('_ago2',getlocal()));
					}		
				}
			}
            return (!empty($ret) ? $ret : null);			
		}   
		return false;
	}
	
	//return dac pages array for update
	protected function get_dac_pages() {
		if (!_m('rccontrolpanel.isLevelUser use 9')) return false;
		
	    //read priv dpc dir
		//compare with root dir
		//return array of newer
		$dirname = $this->prpath . '/';
		$diffdir = $this->prpath . $this->tool_path . 'upgrade-app/cp/';
		
		if (is_dir($dirname)) {
			$mydir = dir($dirname);
			while ($fileread = $mydir->read ()) {
				if (($fileread!='.') && ($fileread!='..') && (!is_dir($fileread)))  {
				
				    $sourcetime = @filemtime($dirname.$fileread);
					$targettime = @filemtime($diffdir.$fileread);
					
					if ((is_readable($diffdir.$fileread)) && 
					    ($sourcetime<$targettime)) {
						
						$datemod = date('Y-m-d H:i', $targettime);
						$ret[$fileread] = str_replace('.php','.dac',$fileread) .
						                  '&nbsp;' . localize('_modified',getlocal()) . 
						                  '&nbsp;' . $this->appkey->nicetime($datemod, localize('_ago2',getlocal()));
					}				
				}
			}
            return (!empty($ret) ? $ret : null);  			
		}   
		return false;
	}	
	
	protected function get_code_expirations() {
		if (!_m('rccontrolpanel.isLevelUser use 9')) return false;
		
	    //read myconfig specific expiration codes
		//compare dates
		//return array of expirations
		if (!defined('RCCONFIG_DPC')) return false;
		
		$exps = _m("rcconfig.get_expirations");
		$uexps = unserialize($exps);
		if (!empty($uexps)) {
			foreach ($uexps as $section=>$key) {
			    $date = $this->appkey->decode_key($key, $section);
				//echo $section,'--->',$key,'--->',$date,'--->','2013-12-14 10:36';
				if ($date) {
				    $now = time();
				    $diff = strtotime($date) - $now;
					$daystosay = 30 * 24 * 60 *60; //30 days
					if ($diff<($daystosay)) //x days or negative=expired					
						$e[$section] = $this->appkey->nicetime($date); 
				}	
			}
			//print_r($e);
			return ($e);
		}
		
		return false;	
	}	

    //read update ini files
    protected function read_update_directory() {
		if (!_m('rccontrolpanel.isLevelUser use 9')) return false;
		
		$dirname = $this->prpath . $this->tool_path . 'update-app/';
  
	    if (is_dir($dirname)) {
			$mydir = dir($dirname);
		 
			while ($fileread = $mydir->read ()) {
	        
				if (($fileread!='.') && ($fileread!='..'))  {
		   
					if ((stristr ($fileread,".ini")) &&
						((substr($fileread,0,9))=='cpwizard-') && //not already updated  	   
						(!is_readable($this->prpath.'/'.str_replace('.ini','._ni',$fileread)))) { 
                      
						$p = explode('-',$fileread);
						$update_name = str_replace('.ini','',$p[1]);
						$ddir[$update_name] = filectime($dirname . $fileread);						
					}
				} 
			}
	      $mydir->close ();
        }

		return ($ddir);
    } 	

    protected function _show_update_tools() {   
        $text = 'update';
		$u = null;
		
		//check for time limited services
		$index = 0;
		if (($codeexpires = $this->get_code_expirations()) && (!empty($codeexpires))) {
		    foreach ($codeexpires as $section=>$exp_text) {
                $module = $section .'_DPC';
				$mod = localize($module, getlocal());
				$update_key_url = $this->call_wizard_url('addkey');//, true);	//is upgrade			

				if ($index<9) 
					$ret .= '<li>
								<span class="label label-warning"><i class="icon-bell"></i></span>
									<span><a href="'.$update_key_url.'">'.$exp_text.'</a></span>
									<div class="pull-right">
                                    <span class="small italic ">'.date("F d Y H:i:s.").'</span>
									</div>
								</li>';
							   
			}
		}		
		
		//check for dpc upgrade
		if (($dpc2copy = $this->get_dpc_modules()) && (!empty($dpc2copy))) {
		    foreach ($dpc2copy as $d=>$dpc) {
				//automated dpc update
				$update_dpc_url = $this->call_wizard_url('dpcmod');//, true);	//is upgrade			
				if ($index<9) 
					$ret .= '<li>
                                <span class="label label-success"><i class="icon-bullhorn"></i></span>
                                    <span><a href="'.$update_dpc_url.'">'.$dpc.'</a></span>
                                    <div class="pull-right">
                                        <span class="small italic ">'.date("F d Y H:i:s.").'</span>
                                    </div>
                             </li>';
                    /*$notify = ' <li>
                                   <a href="#">
                                       <div class="task-info">
                                         <div class="desc">'.$dpc.'</div>
                                         <div class="percent">44%</div>
                                       </div>
                                       <div class="progress progress-striped active no-margin-bot">
                                           <div class="bar" style="width: 44%;"></div>
                                       </div>
                                   </a>
                               </li>'; 
                    if ($index<5) $this->stats['Update']['notify'] .= $notify;*/				
			}	
		}
		
		//check for dac pages to upgrade
		if (($phpdac2copy = $this->get_dac_pages()) && (!empty($phpdac2copy))) {
		    foreach ($phpdac2copy as $p=>$dac) {
				//automated dpc update
				$update_dac_url = $this->call_wizard_url('dacpage');//, true);	//is upgrade			
				if ($index<9) 
						$ret .= '<li>
                                <span class="label label-important"><i class="icon-bullhorn"></i></span>
                                    <span><a href="'.$update_dac_url.'">'.ucfirst(strtolower($dac)).'</a></span>
                                    <div class="pull-right">
                                        <span class="small italic ">'.date("F d Y H:i:s.").'</span>
                                    </div>
                             </li>';

                    /*$notify = ' <li>
                                   <a href="#">
                                       <div class="task-info">
                                         <div class="desc">'.ucfirst(strtolower($dac)).'</div>
                                         <div class="percent">44%</div>
                                       </div>
                                       <div class="progress progress-striped active no-margin-bot">
                                           <div class="bar" style="width: 44%;"></div>
                                       </div>
                                   </a>
                               </li>'; 
                    if ($index<5) $this->stats['Update']['notify'] .= $notify;*/					
			}	
		}	
		
		//check for free space
		if (_m('rccontrolpanel.free_space') < (100*1024*1024)) { //get more in MB..100MB
		    //automated add space
		    $update_url = $this->call_wizard_url('addspace');//, true);	//is upgrade			
			if ($index<9) 
				$ret .= '<li>
                            <span class="label label-important"><i class=" icon-bug"></i></span>
                            <span><a href="'.$update_url.'">'.localize('_addspace', getlocal()).'</a></span>
                            <div class="pull-right">
                                <span class="small italic ">'.date("F d Y H:i:s.").'</span>
                            </div>
                        </li>';		

                /*$notify = ' <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">'.localize('_addspace', getlocal()).'</div>
                                        <div class="percent">44%</div>
                                    </div>
                                    <div class="progress progress-striped active no-margin-bot">
                                        <div class="bar" style="width: 44%;"></div>
                                    </div>
                                </a>
                            </li>'; 
                if ($index<5) $this->stats['Update']['notify'] .= $notify;*/
		}
		
	    $updates = $this->read_update_directory();
		if (!empty($updates)) {
		    arsort($updates);
		    foreach ($updates as $update=>$udatecreated) {
			    //$u .= $udatecreated . '&nbsp;';
                $update_url = $this->call_wizard_url($update, true);
				if ($index<9) 
					$ret .= '<li>
                                <span class="label label-warning"><i class="icon-bullhorn"></i></span>
                                    <span><a href="'.$update_url.'">'.str_replace('_',' ',ucfirst($update)).'</a></span>
                                    <div class="pull-right">
                                        <span class="small italic ">'.date("F d Y H:i:s.", $udatecreated).'</span>
                                    </div>
                             </li>';
					/*$notify = ' <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">'.str_replace('_',' ',ucfirst($update)).'</div>
                                        <div class="percent">44%</div>
                                    </div>
                                    <div class="progress progress-striped active no-margin-bot">
                                        <div class="bar" style="width: 44%;"></div>
                                    </div>
                                </a>
                            </li>'; 
					if ($index<5) $this->stats['Update']['notify'] .= $notify;*/					
			}	
		}

		return ($ret); //true;
    }

	public function show_update_tools()	{
		return $this->_show_update_tools();
	}
	
	
    protected function _show_addons() {//$template=false) { 
      $winh = 'SHOW';
	
      if (!empty($this->environment)) {    
      foreach ($this->environment as $mod=>$val) {
	    
		if ($val) {//enabled
		   $module = strtolower($mod);
		   switch ($module) {
		       case 'dashboard' : $text=null; break; //bypass
			   case 'ckfinder'  : $text=null; break; //bypass
			   
			   case 'edithtml'  : //$text = $this->edit_html_files(false);//true); //cke4
			                      //$winh = 'HIDE';
			                      break; 
			   
			   case 'menu'      : $text=null; break; //bypass

		       case 'awstats'   : //$text = "<a href='cgi-bin/awstats.php'>Awstats</a>";
							   $url = "cgi-bin/awstats.pl?config=". $this->awstats_url ."&framename=mainright#top";
					           $text .= "<IFRAME SRC=\"$url\" TITLE=\"awstats\" WIDTH=100% HEIGHT=400>
										<!-- Alternate content for non-supporting browsers -->
										<H2>Awstats</H2>
										<H3>iframe is not suported in your browser!</H3>
										</IFRAME>";	
                               //$winh = 'SHOW';										
			                   break;			   
		       case 'siwapp' : $text = "<a href='../siwapp/'>Siwapp</a>"; 
			                   /*$url = "http://".str_replace('www.','',$_ENV["HTTP_HOST"])."/siwapp/";			   
					           $text .= "<IFRAME SRC=\"$url\" TITLE=\"siwapp\" WIDTH=100% HEIGHT=400>
										<!-- Alternate content for non-supporting browsers -->
										<H2>Siwapp</H2>
										<H3>iframe is not suported in your browser!</H3>
										</IFRAME>";	*/
							   //$winh = 'SHOW';			
			                   break;
		       default       : $text = null;
			                   //$winh = 'SHOW';
		   }
		  
		   if ($text) {
		    //echo $text,'<br/>';
			$mtitle = localize('_'.$module, getlocal());
		    $tool_url = "help/$module/";
			$this->stats['Addons']['url'][] = $tool_url;
			$this->stats['Addons']['href'][] = $text;
			$_more = localize('_more',getlocal());
		    $ao = '<div class="msg-time-chat">
                        <a class="message-img" href="'.$tool_url.'"><img alt="" src="images/'.$module.'.png" class="avatar"></a>
                        <div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <p>'.$text.'</p>
								<!--p class="attribution"><a href="/help/'.$module.'/">'.$_more.'</a> at 1:55pm, 13th April 2013</p-->
                            </div>
                        </div>
                   </div>';
			$this->stats['Addons']['html'] .= $ao;
		   }		   
		}  
      }		
	  }//if

      return ($addons);	
    }	
	 
    protected function _show_addon_tools() {
		if (!_m('rccontrolpanel.isLevelUser use 9')) return false;
		
		$sl = ($this->seclevid>1) ? intval($this->seclevid)-1 : 1;
	
		if (!empty($this->tools)) {    
		foreach ($this->tools as $tool=>$u_ison) {
			$peruser_ison = explode(',',$u_ison);
			$ison = $peruser_ison[$sl];
		
			$text = null;
			$mytool = strtolower($tool);
			//echo $tool,'<br/>';		   
		
			$e1 = null;//init pre tool
		
			//if (($ison>0) && ($this->environment[strtoupper($tool)]>0)) {//(isset($this->environment[strtoupper($tool)]))) {//enabled
			if ($this->environment[strtoupper($tool)]>0) { //enabled tool
				//echo $tool,'<br/>';	
				switch ($mytool) {
					case 'google_addwords'  : 	$text = "<a href='../analyr/'>Go to addwords</a>"; 
												break;		   
										 
					case 'google_analytics' :	if (is_readable($this->prpath.'ganalytics.html')) 
													$url = "ganalytics.html";
												else 
													$url = "https://analytics.google.com";	   
												$text .= "<IFRAME SRC=\"$url\" TITLE=\"analytics\" WIDTH=100% HEIGHT=400>
													<!-- Alternate content for non-supporting browsers -->
													<H2>Google analytics</H2>
													<H3>iframe is not suported in your browser!</H3>
													</IFRAME>";									
												break;	
					case 'add_recaptcha' 	:  	//$text = "<a href='cpupload.php?editmode=1&encoding=utf-8'>reCAPTCHA ON!</a>";
												$text = "Recaptcha feature installed";
												break;			   
					case 'backup'        	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('backup')) 
													$text = "<a href='$e1'>".localize('_backup_content',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					//case 'uninstall_maildbqueue'   :							
					case 'maildbqueue'   	:   if ($valid = $this->is_valid_newsletter()) {
													$text = localize('_newsletters' ,getlocal());//"Newsletter feature installed"; 
													$text .= ' ('.$valid.')';
												}
												else {//uninstall
													if ($e1 = $this->call_wizard_url('uninstall_maildbqueue')) 
														$text = "<a href='$e1'>".localize('_desendnewsletters',getlocal())."</a>"; 	
													else
														$text = "Unknown tool.";										
												}										
												break;	
					case 'add_domainname'	:   $text = "Domain name ($this->url) installed. ";									
												break;						
					case 'eshop'         	:         
												$message = localize('_uninstalleshop',getlocal());
												if ($valid = $this->is_valid_eshop()) {//uninstall
													$message .= ' ('.$valid.')';
													if ($e1 = $this->call_wizard_url('uninstalleshop')) 
														$text = "<a href='$e1'>".$message."</a>"; 	
													else
														$text = "Unknown tool.";
												}
												else {//install
													if ($e1 = $this->call_wizard_url('eshop')) 
														$text = "<a href='$e1'>".localize('_installeshop',getlocal())."</a>"; 	
													else
														$text = "Unknown tool.";
												}										
												break;
					case 'ckfinder'      	:   $text = "CKfinder installed"; break;
					case 'ieditor'      	:   $text = "IEditor installed"; break;
					case 'printer'       	:   $text = "Printer installed"; break;
					case 'awstats'       	:   $text = "AWStats installed"; break;	
			   
					case 'edit_htmlfiles'	:   //$text = $this->edit_html_files(false, true, true);
												break; 
					case 'addkey'        	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('addkey')) 
													$text = "<a href='$e1'>".localize('_addkey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'genkey'        	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('genkey')) 
													$text = "<a href='$e1'>".localize('_genkey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'validatekey'  	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('validatekey')) 
													$text = "<a href='$e1'>".localize('_validatekey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'cpimages'     	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('cpimages')) 
													$text = "<a href='$e1'>".localize('_cpimages',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;											
					default              	:   //nothing
												$text = null;
				}
			}
			//elseif (($ison>0) && (array_key_exists(strtoupper($tool),$this->environment))) {//($this->environment[strtoupper($tool)]==0)) {
			elseif ((!empty($this->environment)) && (array_key_exists(strtoupper($tool),$this->environment)) && 
		        ($this->environment[strtoupper($tool)]==0)) {
					
				//installed tool no privilege
			}
			elseif ($ison>0) {//disabled tool..enable it, if local privilege is on
				//echo $mytool.'<br/>';
				switch ($mytool) {
					case 'google_addwords'  : 	if ($e1 = $this->call_wizard_url('google_addwords'))
													$text = "<a href='$e1'>Enable addwords</a>"; 
												else
													$text = "Unknown tool."; 
												break;		   
										 
					case 'google_analytics' : 	if ($e1 = $this->call_wizard_url('google_analytics'))
													$text = "<a href='$e1'>Enable analytics</a>"; 
												else
													$text = "Unknown tool.";
												break;
			   							 								
					case 'add_recaptcha'  :	 	if ($e1 = $this->call_wizard_url('add_recaptcha')) 
													$text = "<a href='$e1'>Add recaptcha entry feature</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;
					case 'backup'         :		if ($e1 = $this->call_wizard_url('backup')) 
													$text = "<a href='$e1'>".localize('_backup_content',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;	
					case 'maildbqueue'    :		if ($e1 = $this->call_wizard_url('maildbqueue')) 
													$text = "<a href='$e1'>".localize('_sendnewsletters',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;	
					case 'add_domainname' :	 	if ($e1 = $this->call_wizard_url('add_domainname')) 
													$text = "<a href='$e1'>Change domain name</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;	
					case 'eshop'          :		if ($e1 = $this->call_wizard_url('eshop')) 
													$text = "<a href='$e1'>".localize('_installeshop',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;	
					case 'ckfinder'		  :     if ((!is_dir($this->prpath.'/ckfinder')) && 
												($e1 = $this->call_wizard_url('ckfinder'))) 
													$text = "<a href='$e1'>".localize('_install',getlocal())."</a>"; 	
												else
													$text = null;									 
												break;	
					case 'ieditor' :          	if ((!is_dir($this->prpath.'/ieditor')) &&
												($e1 = $this->call_wizard_url('ieditor'))) 
													$text = "<a href='$e1'>".localize('_install',getlocal())."</a>"; 	
												else
													$text = null;									 
												break;	
					case 'printer' :          	if ((!is_dir($this->prpath.'/printer')) &&
												($e1 = $this->call_wizard_url('printer'))) 
													$text = "<a href='$e1'>".localize('_installprinter',getlocal())."</a>"; 	
												else
													$text = null;									 
												break;											 
					case 'awstats' :        	if ($e1 = $this->call_wizard_url('awstats')) 
													$text = "<a href='$e1'>Enable AWStats</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
										 
					case 'edit_htmlfiles'   : 	if ($e1 = $this->call_wizard_url('edit_htmlfiles')) 
													$text = "<a href='$e1'>Edit html files</a>"; 	
												else
													$text = "Unknown tool.";									 
												break;	
					case 'addkey'        	:  	//always repeat...
												if ($e1 = $this->call_wizard_url('addkey')) 
													$text = "<a href='$e1'>".localize('_addkey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'genkey'        :  	//always repeat...
												if ($e1 = $this->call_wizard_url('genkey')) 
													$text = "<a href='$e1'>".localize('_genkey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'validatekey'  :  		//always repeat...
												if ($e1 = $this->call_wizard_url('validatekey')) 
													$text = "<a href='$e1'>".localize('_validatekey',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;	
					case 'cpimages'     :  		//always repeat...
												if ($e1 = $this->call_wizard_url('cpimages')) 
													$text = "<a href='$e1'>".localize('_cpimages',getlocal())."</a>"; 	
												else
													$text = "Unknown tool.";
												break;											
					default                 :	 //nothing
												$text = null;
				}		
			}
			//else disabled tool...		
		
			if ($text) {
				$tool_url = $text ? ($e1 ? $e1 : "help/$mytool/") : null;
				$_more = localize('_more',getlocal());
				$ret .= '<div class="msg-time-chat">
                        <a class="message-img" href="'.$tool_url.'"><img alt="" src="images/'.$mytool.'.png" class="avatar"></a>
                        <div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <p>'.$text.'</p>
								<!--p class="attribution"><a href="/help/'.$mytool.'/">'.$_more.'</a> at 1:55pm, 13th April 2013</p-->
                            </div>
                        </div>
                   </div>';
			}		
		}	//foreach	
		}//if
	
		return ($ret); //true;
    }	

	public function show_addon_tools() {
		return $this->_show_addon_tools();
	}	
	 
	protected function set_addons_list() {
	
		$this->tools['google_analytics'] = '0,0,0,0,0,0,0,1,1';
		$this->tools['add_recaptcha'] = '0,0,0,0,0,0,0,1,1';
		$this->tools['add_domainname'] = '0,0,0,0,0,0,0,0,1';
		$this->tools['maildbqueue'] = '0,0,0,0,0,0,0,0,1';
		$this->tools['item_photo'] = '0,0,0,0,0,0,0,0,1';
		//$this->tools['uninstall_maildbqueue'] = '0,0,0,0,0,0,0,1,1';
		//$this->tools['add_addwords'] = '0,0,0,0,0,0,0,1,1';					 		
		//$this->tools['jqgrid'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['ieditor'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['printer'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['ckfinder'] = '0,0,0,0,0,0,0,0,1';//priv for setup

		$this->tools['edit_htmlfiles'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['cpimages'] = '0,0,0,0,0,0,0,1,1';
		$this->tools['awstats'] = '0,0,0,0,0,0,0,1,1';
		
		//keys
		$this->tools['addkey'] = '0,0,0,0,0,0,0,1,1';//no priv for setup
		$this->tools['genkey'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['validatekey'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['backup'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		$this->tools['eshop'] = '0,0,0,0,0,0,0,0,1';//priv for setup
		//$this->tools['uninstalleshop'] = '0,0,0,0,0,0,0,0,1';//priv for setup		
			
	} 


    //as call_upgrade_ini into rcuwizard dpc
    //in case of update must be also here for wizard to play..
    //in case of update is only for read and history reasons
    protected function call_wizard_url($addon=null,$isupdate=false) {
        if (!$addon) return false;
		
		$upgrade_root_path = $this->prpath . $this->tool_path . 'upgrade-app/';	
		$update_root_path = $this->prpath . $this->tool_path . 'update-app/'; 
		
		$r_path = $isupdate ? $update_root_path : $upgrade_root_path;
		
	    $inifile = $r_path . "cpwizard-".$addon.".ini";
		$target_inifile = $this->prpath . "cpwizard-".$addon.".ini";
		$installed_inifile = str_replace('.ini','._ni',$target_inifile);
		//echo $inifile,'<br/>';
		
		if ((is_readable($target_inifile)) || ((is_readable($inifile)))){//already copied or fetch from root app

            /*$url = $isupdate ? seturl('t=cpwupdate&wf='.$addon) : 
			                   seturl('t=cpupgrade&wf='.$addon);*/
			//in case of update url is the same...as upgrade
            $url = 'cpupgrade.php?wf='.$addon; //seturl('t=cpupgrade&wf='.$addon);			
		}
        else
            $url = false; 		
			
        return ($url);		
    }

    public function is_valid_eshop() {
   	  
		$timekey = remote_paramload('SHCART','expires',$this->prpath);
		//echo $timekey;
		if ($timekey) {
			//$timeleft = $this->appkey->decode_key($timekey, 'SHCART', true);
			$date = $this->appkey->decode_key($timekey, 'SHCART');

			//if ($timeleft>0) {
			if ($date) {
				$daystosay = 30 * 24 * 60 *60; //30 days			
			    //if ($timeleft<($daystosay))//x days or negative=expired
			        //return true;
					
				$now = time();
				$diff = strtotime($date) - $now;
				//if ($diff<($daystosay)) {//x days or negative=expired					
					$ret = $this->appkey->nicetime($date); 
					//echo $ret;
					return ($ret);//true with text
				//}	
			}		
		}
	  
	    return false;
    } 

    //check if newsletter feature is valid
    public function is_valid_newsletter() {
   	  
		//installed mailqueue key
		$timekey = remote_paramload('RCBULKMAIL','expires',$this->prpath);

		if ($timekey) {
			$date = $this->appkey->decode_key($timekey, 'RCBULKMAIL'); 

			if ($date) {
				$daystosay = 30 * 24 * 60 *60; //30 days			
					
				$now = time();
				$diff = strtotime($date) - $now;
				//if ($diff<($daystosay)) {//x days or negative=expired					
					$ret = $this->appkey->nicetime($date); 
					//echo $ret;
					return ($ret);//true with text
				//}	
			}		
		}

	    return false;
    }	
  
};
}
?>