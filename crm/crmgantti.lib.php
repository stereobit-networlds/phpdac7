<?php
define("GANTTI_DPC",true);

$__DPC['GANTTI_DPC'] = 'Gantti';

require_once('calendar.lib.php'); 

class Gantti {

  var $cal       = null;
  var $data      = array();
  var $first     = false;
  var $last      = false;
  var $options   = array();
  var $cellstyle = false;
  var $blocks    = array();
  var $months    = array();
  var $days      = array();
  var $seconds   = 0;
  
  var $is_owner;

  function __construct($data, $params=array(), $is_owner=false) {
    
    $defaults = array(
      'title'      => false,
      'cellwidth'  => 40,
      'cellheight' => 40,
      'today'      => true,
    );
        
    $this->options = array_merge($defaults, $params);    
    $this->cal     = new Calendar();
    $this->data    = $data;
    $this->seconds = 60*60*24;

    $this->cellstyle = 'style="width: ' . $this->options['cellwidth'] . 'px; height: ' . $this->options['cellheight'] . 'px"';
	
    $this->is_owner = $is_owner;
	
    // parse data and find first and last date  
    $this->parse();                
                    
  }

  function parse() {
    
    foreach($this->data as $d) {
              
      $this->blocks[] = array(
        'label' => $d['label'],
        'start' => $start = strtotime($d['start']),
        'end'   => $end   = strtotime($d['end']),
        'class' => @$d['class'],
		'link'  => $d['link'], //add link
		'project'  => $d['project'], //add link
		'ptitle'  => $d['project_title'], //add link
		'group'  => $d['group'], //group by
		'owner'  => $d['owner'], //owner
		'code'   => $d['code'], //project code
      );
      
      if(!$this->first || $this->first > $start) $this->first = $start;
      if(!$this->last  || $this->last  < $end)   $this->last  = $end;
          
    }
    
    $this->first = $this->cal->date($this->first);
    $this->last  = $this->cal->date($this->last);

    $current = $this->first->month();
    $lastDay = $this->last->month()->lastDay()->timestamp;

    // build the months      
    while($current->lastDay()->timestamp <= $lastDay) {
      $month = $current->month();
      $this->months[] = $month;
      foreach($month->days() as $day) {
        $this->days[] = $day;
      }
      $current = $current->next();
    }
        
  }

  function render() {
    
    $html = array();
    
    // common styles    
    $cellstyle  = 'style="line-height: ' . $this->options['cellheight'] . 'px; height: ' . $this->options['cellheight'] . 'px"';
    $wrapstyle  = 'style="width: ' . $this->options['cellwidth'] . 'px"';
    $totalstyle = 'style="width: ' . (count($this->days)*$this->options['cellwidth']) . 'px"';
    // start the diagram    
    $html[] = '<figure class="gantt">';    
	
    // set a title if available
    if (($this->options['title'])/*||($new_project)*/) {
      $html[] = '<figcaption>' . $this->options['title'] . '</figcaption>';
    }

    // sidebar with labels
    $html[] = '<aside>';
    $html[] = '<ul class="gantt-labels" style="margin-top: ' . (($this->options['cellheight']*2)+1) . 'px">';
    foreach($this->blocks as $i => $block) {
	  if (defined('XIXUSER_DPC')) {
	  
	    $user_href = GetGlobal('controller')->calldpc_method("xixuser.get_href use ".$block['label'].'+'.$block['project']);
		$html[] = '<li class="gantt-label"><strong ' . $cellstyle . '>' . $user_href . '</strong></li>';      
	  }
	  else
		$html[] = '<li class="gantt-label"><strong ' . $cellstyle . '>' . $block['label'] . '</strong></li>';      
    }
    $html[] = '</ul>';
    $html[] = '</aside>';

    // data section
    $html[] = '<section class="gantt-data">';
        
    // data header section
    $html[] = '<header>';

    // months headers
    $html[] = '<ul class="gantt-months" ' . $totalstyle . '>';
    foreach($this->months as $month) {
		
	  //$html[] = '<li class="gantt-month" style="width: ' . ($this->options['cellwidth'] * $month->countDays()) . 'px"><strong ' . $cellstyle . '>' . $new_project . localize($month->name(),getlocal()) . '</strong></li>';	
	  
	  if ($this->is_owner) {
	  
	    $newp_label = localize($month->name(),getlocal());
		
		if (defined('CRMACAL_DPC')) {
			//$mydate = time(); //current month
			$mydate = strtotime($month->name().' '.date('Y'));
			$new_project = GetGlobal('controller')->calldpc_method("crmacal.get_href use $mydate+$newp_label");
		}	
		else { 
			$owner_href = 'javascript: void(0)';
		    $new_project = "<a class='btn btn-small' href='#' $owner_href><i class='icon-bolt'></i>$newp_label</a>";	
		}   
        $html[] = '<li class="gantt-month" style="width: ' . ($this->options['cellwidth'] * $month->countDays()) . 'px"><strong ' . $cellstyle . '>' .$new_project. '</strong></li>';	
	  }
      else
		$html[] = '<li class="gantt-month" style="width: ' . ($this->options['cellwidth'] * $month->countDays()) . 'px"><strong ' . $cellstyle . '>' . localize($month->name(),getlocal()) . '</strong></li>';
    }                      
    $html[] = '</ul>';    

    // days headers
    $html[] = '<ul class="gantt-days" ' . $totalstyle . '>';
    foreach($this->days as $day) {

      $weekend = ($day->isWeekend()) ? ' weekend' : '';
      $today   = ($day->isToday())   ? ' today' : '';

      $html[] = '<li class="gantt-day' . $weekend . $today . '" ' . $wrapstyle . '><span ' . $cellstyle . '>' . $day->padded() . '</span></li>';
    }                      
    $html[] = '</ul>';    
    
    // end header
    $html[] = '</header>';

    // main items
    $html[] = '<ul class="gantt-items" ' . $totalstyle . '>';
        
    foreach($this->blocks as $i => $block) {
      
      $html[] = '<li class="gantt-item">';
      
      // days
      $html[] = '<ul class="gantt-days">';
      foreach($this->days as $day) {

        $weekend = ($day->isWeekend()) ? ' weekend' : '';
        $today   = ($day->isToday())   ? ' today' : '';

        $html[] = '<li class="gantt-day' . $weekend . $today . '" ' . $wrapstyle . '><span ' . $cellstyle . '>' . $day . '</span></li>';
      }                      
      $html[] = '</ul>';    

      // the block
      $days   = (($block['end'] - $block['start']) / $this->seconds);
      $offset = (($block['start'] - $this->first->month()->timestamp) / $this->seconds);
      $top    = round($i * ($this->options['cellheight'] + 1));
      $left   = round($offset * $this->options['cellwidth']);
      $width  = round($days * $this->options['cellwidth'] - 9);
      $height = round($this->options['cellheight']-8);
      $class  = ($block['class']) ? ' ' . $block['class'] : '';
	  
	  //override href for timeline links
	  $rdays = round($days);
	  if ((defined('CRMACAL_DPC')) && ($block['link']))  {
		 $mydate = $block['start']; //is timestamp
		 $project = $block['project'];
		 $ptitle = $block['ptitle'];
		 $code = $block['code'];
		 $href = GetGlobal('controller')->calldpc_method("crmacal.get_href use $mydate+$rdays++".$project.'+'.$ptitle.'+'.$code);//+1 for date format Y-m-d,+project id,title 
	  }
      else {
	 	 $href = 'javascript: void(0)';	  
         //days = href, link
	     $href   = $block['link'] ? "<a class='btn btn-small' href='".str_replace('0',$rdays,$block['link'])."'>{$rdays}</a>" : $days;		 
	  }
	  $group = $block['group'];
	  
      $html[] = '<span class="gantt-block' . $class . 
	            '" style="left: ' . $left . 
				'px; width: ' . $width . 
				'px; height: ' . $height . 'px"><strong class="gantt-block-label">' . 
				$href . 
				'</strong></span>';
      $html[] = '</li>';
    
    }
    
    $html[] = '</ul>';    
    
    if($this->options['today']) {
    
      // today
      $today  = $this->cal->today();
      $offset = (($today->timestamp - $this->first->month()->timestamp) / $this->seconds); 
      $left   = round($offset * $this->options['cellwidth']) + round(($this->options['cellwidth'] / 2) - 1);
          
      if($today->timestamp > $this->first->month()->firstDay()->timestamp && $today->timestamp < $this->last->month()->lastDay()->timestamp) {
        $html[] = '<time style="top: ' . ($this->options['cellheight'] * 2) . 'px; left: ' . $left . 'px" datetime="' . $today->format('Y-m-d') . '">Today</time>';
      }

    }
    
    // end data section
    $html[] = '</section>';    

    // end diagram
    $html[] = '</figure>';

    return implode('', $html);
      
  }
  
  function __toString() {
    return $this->render();
  }

}