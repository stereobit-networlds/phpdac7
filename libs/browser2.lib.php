<?php

$__DPCSEC['SEARCHTOPIC_']='1;1;1;1;1;1;2;2;2;2;9';
$__DPCSEC['VIEWSTLS_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['ADMBROWSE_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['ALLBROWSE_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['PDFBROWSE_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['EXCELBROWSE_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['MAILBROWSE_']='1;1;1;1;1;1;1;1;1;2;9';
$__DPCSEC['PAGELENGTH_']='1;1;1;1;1;1;1;1;1;2;9';

if (!defined("BROWSER2_DPC")) {
define("BROWSER2_DPC",true);

$__DPC['BROWSER2_DPC'] = 'browse';

$__EVENTS['BROWSER2_DPC'][0]='searchtopic';
$__ACTIONS['BROWSER2_DPC'][0]='searchtopic';

$__DPCATTR['BROWSER_DPC']['searchtopic'] = 'searchtopic,0,0,0,0,0,1,0,0,1'; 

$__LOCALE['BROWSER2_DPC'][0]='_VIEWSTYLES;View styles;Μορφή';
$__LOCALE['BROWSER2_DPC'][1]='_SORT;Sort;Ταξ.';
$__LOCALE['BROWSER2_DPC'][2]='_PAGE;Page;Σελίδα';
$__LOCALE['BROWSER2_DPC'][3]='_EMPTYDIR;Not availbale products;Κανένα διαθέσιμο προϊόν';
$__LOCALE['BROWSER2_DPC'][4]='_NEXT;Next;Επόμενο';
$__LOCALE['BROWSER2_DPC'][5]='_PREV;Prev;Προηγούμενο';
$__LOCALE['BROWSER2_DPC'][6]='_BEGIN;Begin;Αρχή';
$__LOCALE['BROWSER2_DPC'][7]='_END;End;Τέλος';
$__LOCALE['BROWSER2_DPC'][8]='_ALLBROWSE;Show All;Προβολή Όλων';
$__LOCALE['BROWSER2_DPC'][9]='_SEARCH;Search;Αναζήτηση';
$__LOCALE['BROWSER2_DPC'][10]='_GROUPOF;Group;Ομαδα';

class browse {

	var $userLevelID;
    var $outpoint;
    var $rightarrow;
    var $view_on;
	var $home;
	var $pagedfiles;
	var $page;
	var $pagenum;
	var $title;
	var $datalist;
	var $sortmethod;
	var $defaultview;

    var $start_b;
    var $end_b;
	var $next_b;
    var $prev_b;
	var $selpage;
	var $stylearray;
	var $styler;
	var $columns;	
	
	var $dosearch;
	var $searchtext;
	
	var $timeout;
	
	var $alltitle;

	public function __construct($data='',$title='',$selpage=1,$styler="",$columns="") {
	    $UserSecID = GetGlobal('UserSecID');	
		$PL = GetReq('pl');

        $this->userLevelID = (((decode($UserSecID))) ? (decode($UserSecID)) : 0);
		
	    $this->searchtext = trim(GetParam("searcht"));	
		if (!$this->searchtext) $this->searchtext = GetReq('a'); //set $a as search topic
        if ($this->searchtext) $this->dosearch = 1; 
		                  else $this->dosearch = 0; 
		
        $this->datalist     = $data;       
        $this->title        = $title;
		$this->sortmethod   = GetSessionParam('sort'); 
		$this->pagedfiles   = array();
		$this->page         = 0;
		$this->pagenum      = ($PL ? $PL:10); //default
		$this->selpage      = $selpage;
		$this->columns      = $columns; //added due to a xml support
				
		$this->stylearray   = explode(",",$styler);
		$this->styler       = $styler;	
		
	    $this->timeout = paramload('SHELL','timeout');				 
		
        $this->outpoint = loadTheme('point');      
        $this->rightarrow = loadTheme('rarrow');
        $this->start_b = loadTheme('start',localize('_BEGIN',getlocal()));
        $this->end_b = loadTheme('end',localize('_END',getlocal()));
        $this->next_b = loadTheme('next',localize('_NEXT',getlocal()));
        $this->prev_b = loadTheme('prev',localize('_PREV',getlocal()));

   	    $this->alltitle = localize('_ALLBROWSE',getlocal());	
        	
    }
	
	public function render($viewtype=0,$pager,$class,$pagemaker=0,$topic=0,$sorter=0,$adminform=0,$excel=0,$pdf=0,$mail=0,$all=0) {

        if (is_array($this->datalist)) {
		    //set page length
			if ($pager) $this->pagenum = $pager;
            //sort files
		    $this->sort_files();
									
            if (($pagemaker) && (GetReq('param1')!='-all')) {
			    //get searched data
				$this->selpage = $this->getpage($this->searchtext);
			    //make pages		 
		        $this->read_pagefiles();
                //preview 
		        $out = $this->browse_files($viewtype,$class,$pagemaker,$topic,$sorter,$adminform,$excel,$pdf,$mail,$all);		
		    }
			else {
		        $out = $this->browse_all_files($viewtype,$class);
				$out .= $this->browse_advance($topic,$excel,$pdf,$mail,null);
			}  			   
		    return($out);
    	}
    }

    protected function read_pagefiles() {

		$meter = 0;
        $pnum = $this->pagenum;
			   
	    reset($this->datalist); //print_r($this->datalist);
        foreach ($this->datalist as $file_num => $filename) {	

			if ($meter >= $pnum) {
				$meter=0;
				$this->page+=1;
			}

			$this->pagedfiles[$this->page][$meter] = $filename; 
			$meter+=1;
		}

        reset ($this->datalist); 
        reset ($this->pagedfiles);

		return ($this->pagedfiles);
	}

    protected function browse_files($view,$class,$pagemaker,$topic,$sorter,$adminform,$excel,$pdf,$mail,$all) { 
		
		$t = GetReq('t');
		$p = GetReq('p'); 
     	$gr = urlencode(GetReq('g'));
		
        if (($adminform) && (seclevel('ADMBROWSE_',$this->userLevelID))) 
			$out = $this->admin_start();		

        if ($this->pagedfiles) {
		    		
            // view styles and sort method line
            if (count($this->stylearray)>1)  
				$vs = $this->viewStyles();
			if ($sorter) 
				$sv = $this->sortStyles();				  

			$winout .= $vs . $sv;
			
            //read current page array 
            if ($pagemaker) { 
		        if (!$p) $mypage=$this->selpage;
					else $mypage=$p; 
			    $realpage = ($mypage-1);				   
			}
			else 
			    $realpage=0;				 
			   
			$currentpagefiles = (array) $this->pagedfiles[$realpage];
		 
            if (method_exists($class,'headtitle')) 
			    $winout .= $class->headtitle($view);
		
		    if (method_exists($class,'browse')) {		
	            foreach ($currentpagefiles as $file_num => $filename) {	
			        $packdata = str_replace(";","||",$filename);
		            $winout .= $class->browse($packdata,$view);
                }
            }
			else 
			    die("Method 'browse' required !");	
			   				
			$out .= $winout;	 
	    } 
        else 
           $out = ''; 

        if (($adminform) && (seclevel('ADMBROWSE_',$this->userLevelID))) 
			$out .= $this->admin_end();
						
        $out .= $this->browse_advance($topic,$excel,$pdf,$mail,$all);									
		
		//view page browser
	    if ($pagemaker) 
			$out .= $this->pageBrowser($view);	
				 			 
		
        return ($out);
    }

	
    public function pageBrowser($view) {
		$gr = urlencode(GetReq('g'));		
	    $p = GetReq('p');	
		$pl = GetReq('pl');			
		$view = $view ? $view : GetReq('t'); 		

		$grouppager = 2;
        $ptext = localize('_PAGE',getlocal()) . " :";

        if ($this->page>0) {
			
			$template = _m('cmsrt.select_template use pagination-element');			

			//initialize page
			if (!$p) 
				$p = $this->selpage;
          
			$groupprev = (($p-1) - $grouppager); 
			if ($groupprev<=0) 
				$groupprev = 0;
			else 
				$markstart = "..."; 
			$groupnext = (($p-1) + $grouppager); 
			if ($groupnext>$this->page) 
				$groupnext = $this->page;
			else 
				$markend = "...";

			//prev buttons
			$prevpage = $p-1;
			//$data .= seturl("t=$view&a=&g=$gr&p=1&pl=$pl", $this->start_b) . "&nbsp;";
			$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=1&pl=$pl"),1=>'«'));
			if ($prevpage>0) 
				//$data .= seturl("t=$view&a=&g=$gr&p=$prevpage&pl=$pl", $this->prev_b);
			    $data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=$prevpage&pl=$pl"),1=>'&lt;'));
			else 
				$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=1"),1=>'&lt;'));
			
			//$data .= $markstart;
			//$data .= $this->combine_tokens($template, array(0=>'#',1=>$markstart));
			//$data .= " " . $this->outpoint . " ";

			for ($i=$groupprev; $i<=$groupnext; $i++) {
				$pp = $i+1;
				if ($pp==$p) 
					//$data .= seturl("t=$view&a=&g=$gr&p=$pp&pl=$pl","<B>" . $pp . "</B>") . "&nbsp;" . $this->outpoint . "&nbsp;";
					$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=$pp&pl=$pl"),1=>$pp,2=>' class="current"'));
				else 
					//$data .= seturl("t=$view&a=&g=$gr&p=$pp&pl=$pl",$pp) . "&nbsp;" . $this->outpoint . "&nbsp;";	
					$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=$pp&pl=$pl"),1=>$pp));

			}
			//$data .= $markend;
			//$data .= $this->combine_tokens($template, array(0=>'#',1=>$markend));
 
			//next buttons
			$nextpage = $p+1;
			if ($nextpage<=$this->page+1) 
				//$data .= seturl("t=$view&a=&g=$gr&p=$nextpage&pl=$pl" , $this->next_b);	
				$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=$nextpage&pl=$pl"),1=>'&gt;'));
			else 
				//$data .= $this->next_b; 
				$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=" . ($this->page+1)),1=>'&lt;'));
				
			//$data .= "&nbsp;" . seturl("t=$view&a=&g=$gr&p=" . ($this->page+1) . "&pl=$pl" , $this->end_b );
			$data .= $this->combine_tokens($template, array(0=>seturl("t=$view&a=&g=$gr&p=" . ($this->page+1) . "&pl=$pl"),1=>'»'));

			//buttons browser
			$mydata[] = $data;

			//page number
			$mydata[] = $ptext; 
			$mydata[] = $p;
			$mydata[] = $this->page+1;
			//$mydata[] = $this->pagelength();		  
		  
			$template = _m('cmsrt.select_template use pagination');
			$out = $this->combine_tokens($template, $mydata);
        }

		return ($out);
    }
	
	public function browse_all_files($view,$class) {
	
	    if (method_exists($class,'headtitle')) 
			 $winout .= $class->headtitle($view);	
		 
	    reset($this->datalist);
		 
		if (method_exists($class,'browse')) {						 
			foreach ($this->datalist as $rec_num => $rec) {
			    $packdata = str_replace(";","||",$rec);
		        $winout .= $class->browse($packdata,$view);
		    }
		}  
	
		return ($winout);	
	}

    public function viewStyles() {	

	    $g = GetReq('g');		
	    $p = GetReq('p');
	    $t = GetReq('t'); 				
	    $a = GetReq('a');		
		
        if (seclevel('VIEWSTLS_',$this->userLevelID)) {

          $vprint = localize('_VIEWSTYLES',getlocal()) . " :";

          foreach ($this->stylearray as $stylenum => $style) {		  
            if ($t==$style) $vprint .= "(".$style.")"; 
	                   else $vprint .= seturl("t=$t&a=$a&g=$g&p=$p&s=$style", $style); 
		  }
		}
  			
        return ($vprint);
    }
	
	//select page length (num of lines)
	protected function pagelength() {		
	    $g = GetReq('g');		
	    $p = GetReq('p');
	    $t = GetReq('t'); 				
	    $a = GetReq('a'); //not need??
	    $s = GetReq('s');
		$pl = GetReq('pl');		
		
          $vprint = localize('_GROUPOF',getlocal()) . " :";

          for ($i=1;$i<6;$i++) {		  
            if ($pl==($i*10)) 
			  $vprint .= "(".$pl.")"; 
	        else 
			  $vprint .= seturl("t=$t&a=$a&g=$g&p=1&s=$s&pl=".($i*10), "[".($i*10))."]"; 
		  }
  			
        return ($vprint);	
	}	

	protected function sortStyles() {		
		$gr = urlencode(GetReq('g'));
	    $p = GetReq('p');
	    $t = GetReq('t'); 				
	    $a = GetReq('a');
		$s = GetReq('s');		

        $vprint .= localize('_SORT',getlocal()) . " :";

        if ($this->sortmethod==1) $vprint .= seturl("t=$t&a=1&g=$gr&p=$p&s=$s", "<b>A</b>"); 
                             else $vprint .= seturl("t=$t&a=1&g=$gr&p=$p&s=$s","A"); 
        if ($this->sortmethod==-1) $vprint .= seturl("t=$t&a=-1&g=$gr&p=$p&s=$s", "<b>Z</b>"); 
    	                      else $vprint .= seturl("t=$t&a=-1&g=$gr&p=$p&s=$s","Z"); 			  
        return ($vprint);
	}

	protected function sort_files() {

        //sorting (article=selected sort method, saved as session param)
        //first sort by saved method (if saved)
        switch ($this->sortmethod) {
	       case "1"  : ksort ($this->datalist,SORT_REGULAR); break; //asc
	       case "-1" : krsort ($this->datalist,SORT_REGULAR); break; //desc
           default : ksort ($this->datalist); //asc
        }					
        //secont sort by selected method (if selected) and save sort
        switch (GetReq('a')) {
	       case 1  : ksort ($this->datalist,SORT_STRING); SetSessionParam("sort", "1"); break; //asc
	       case -1 : krsort ($this->datalist,SORT_STRING); SetSessionParam("sort", "-1"); break; //desc
           default : ksort ($this->datalist); //asc		   
        }  
   		$this->sortmethod = GetSessionParam('sort');

		//print_r($this->dfiles);
	}


    protected function admin_start() {
	   if (GetReq('editmode'))
	      $edmode = '&editmode=1';
	   else
	      $edmode = null; 		   
	   $gr = urlencode(GetReq('g'));
	   $ar = urlencode(GetReq('a'));
	   $p = GetReq('p');
	   $t = GetReq('t');   
       $filename = seturl("t=$t&a=$ar&g=$gr&p=$p".$edmode);		   
 
       $out = "<form action=". "$filename" . " method=post class=\"thin\">"; 
  
       return ($out);
    }

    protected function admin_end() {	   
	   $sFormErr = GetGlobal('sFormErr');
	   
       //error message
       $toprint .= setError($sFormErr);
	   $toprint .= $this->admin_commands();
	   $toprint .= "</form>"; 
	   $toprint .= $this->admin_actions();		   
  
       return ($toprint);
     }
 
    function searchTopic()  {		    
	  $t = GetReq('t');	
      $pl = GetReq('pl');	
	  $gr = urlencode(getReq('g')); 

      $filename = seturl("t=$t&a=&g=$gr&pl=$pl");      

      $toprint  = "<FORM action=". $filename . " method=post class=\"thin\">";
      $toprint .= "<P><FONT face=\"Arial, Helvetica, sans-serif\" size=1><STRONG>";
      $toprint .= localize('_SEARCH',getlocal()) . ":";
	  $toprint .= "</STRONG> <INPUT name=searcht size=15></FONT>";
      $toprint .= "<FONT face=\"Arial, Helvetica, sans-serif\" size=1>";

      $toprint .= "<input type=\"submit\" name=\"Submit\" value=\"Ok\">"; 
      $toprint .= "<input type=\"hidden\" name=\"FormAction\" value=\"searchtopic\">";
      $toprint .= "</FONT></FORM>";

      return ($toprint);	   
    }	
	
	
	protected function viewall($viewtype,$class) {

      if (seclevel('ALLBROWSE_',$this->userLevelID)) {	
	  	
	    $t = GetReq('t');
		$a = GetReq('a');
		$g = GetReq('g');
		$p = GetReq('p');
	  
	    if (!GetReq('v')) {	//just generate link  
	      $out = seturl("t=$t&a=$a&g=$g&p=$p&v=all",$this->alltitle) . "&nbsp;";
		}
		else { //generate all list
          $out = $this->browse_all_files($viewtype,$class);
		  DelReq('v'); //reset value for other browsing objects 
		}	
	  }
	  
	  return ($out);	  
	}
	
	public function browse_advance($topic=0,$excel=0,$pdf=0,$mail=0,$all=0) {
	
		//search topic				
 	    if (($topic) && (seclevel('SEARCHTOPIC_',$this->userLevelID))) 
		  $out = $this->searchTopic();

					
 	    if (($all) && (seclevel('ALLBROWSE_',$this->userLevelID)))  
		  $out .= $this->viewAll(null,null);
	  
	    return ($out);
	}
	
	function getpage($id){

      //print_r($array);
	  if ($id) {
	     $i=1;
		 $page=1;
         //ksort ($this->datalist,SORT_REGULAR);			 
		 reset($this->datalist);
         //while(list ($num, $data) = each ($this->datalist)) {
         foreach ($this->datalist as $num => $data) {	
		    $msplit = explode(";",$data); 
			
			if ( (stristr($msplit[0],$id)) || //code
			     (stristr($msplit[1],$id)) || //title
				 (stristr($msplit[6],$id)) || //descr
				 (stristr($msplit[8],$id))) { //price
				 
			     $a = $msplit[1];
				 SetReq('a',$msplit[1]);//NOT WORK
				 //$ret = floor(($i) / $this->pagenum);//+1;
				 //echo '++++',$i,'>',$ret,'>',$this->pagenum,'++++';
                 //echo $page;
			     return $page;//ret;
			}	 
			$i+=1; 
		    if ($i>($this->pagenum*$page)) $page+=1;//echo $page;			
		 }	  
	   }	 
	   return 1;
	}	
	
	//in form actions
    function admin_commands() {

	  $__BROWSECOM = GetGlobal('__BROWSECOM');
	  $__DPC = GetGlobal('__DPC');	  
	  
	  if (is_array($__BROWSECOM)) {
	  
	    reset($__BROWSECOM);
	    foreach ($__BROWSECOM as $dpc_name => $func) {//print $func;
           if (defined($dpc_name)) {
			  $theclass = new $__DPC[$dpc_name];
              $out .= $theclass->$func();
			  unset ($theclass);
			}  
	    }
	    return $out;	 
	  }
    }		
	
	//after </form> actions
    protected function admin_actions() {

	  $__BROWSEACT = GetGlobal('__BROWSEACT');
	  $__DPC = GetGlobal('__DPC');		  
	  
	  if (is_array($__BROWSEACT)) {
	  
	    reset($__BROWSEACT);
	    foreach ($__BROWSEACT as $dpc_name => $func) {//print $func;
           if (defined($dpc_name)) {
			  $theclass = new $__DPC[$dpc_name];
              $out .= $theclass->$func();
			  unset ($theclass);
		   }  
	    }
	    return $out;	 
	  }
    }

	protected function combine_tokens(&$template_contents, $tokens, $execafter=null) {
	    if (!is_array($tokens)) return;
		
		if ((!$execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$ret = $fp->process_commands($template_contents);
			unset ($fp);		  		
		}		  		
		else
			$ret = $template_contents;
		  
	    foreach ($tokens as $i=>$tok) {
		    $ret = str_replace("$".$i."$",$tok,$ret);
	    }

		for ($x=$i;$x<40;$x++)
			$ret = str_replace("$".$x."$",'',$ret);
		
		if (($execafter) && (defined('FRONTHTMLPAGE_DPC'))) {
			$fp = new fronthtmlpage(null);
			$retout = $fp->process_commands($ret);
			unset ($fp);
          
			return ($retout);
		}		
		
		return ($ret);
	}		
   
};
}
?>