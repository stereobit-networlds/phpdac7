<?php

class gtkds {

   private $window, $agentbox;
   private $errors;
   private $code_sep;
   
   private $gtk_conn;
   private $standalone;//mode 
   
   private $env;

   function __construct($env=null,$standalone=null) {
   
	 $this->errors = array();
	 $this->code_sep = "\r\n<-->\r\n";   
	 $this->standalone = $standalone;
	 if ($env) $this->env = $env;

	 //initialize GTk connector .. for inside this proc call and standalone purposes
   /*  echo("GTK connector loaded!\n");	  
	 $this->gtkds_conn = new gtkds_connector(); 
	  
   
	 $this->window = &new GtkWindow();	
	 //$window->set_policy(false, false, false);
	 $this->window->set_title('phpDAC5-'.$this->env->env['name']);
	 $this->window->set_size_request(640, 480);
	 $this->window->set_position(GTK_WIN_POS_CENTER);
	
     $basebox = &new GtkVBox();
	 $this->window->add($basebox);		
	
     $this->agentbox = &new GtkHBox(false,5);
	 $this->agentbox->set_border_width(5);		
	 $basebox->pack_start($this->agentbox,false);			
	
     $this->window->realize();
	
	 $this->window->connect('destroy', array(&$this,'destroy'));    
	
	 $this->window->show_all();		
   
	 $this->there_is_code(); //first time code search
	 
	 
     //Gtk::timeout_add(1000, array(&$this,'there_is_code'));			 
	 */
	 //Gtk::main();
	 /*while (Gtk::events_pending()) {
         Gtk::main_iteration();//(false);
     }*/
	 
	 /*
		if (!@$GLOBALS['framework']) {
			new WindowTest($env);
			Gtk::main();
		}	 
	  */

/**
* In this part of the code, indenting matches the
* widgets containment, not the code structure
*/
$win = new GtkWindow();
  $vbox = new GtkVPaned();
    $win->add($vbox);
      $scrolled_win = new GtkScrolledWindow();
      $scrolled_win->set_policy(Gtk::POLICY_AUTOMATIC, Gtk::POLICY_AUTOMATIC);
      $vbox->add1($scrolled_win);
 
        $php_edit = new PhpEditWidget();
        $php_edit->load_file(__FILE__);
        $scrolled_win->add_with_viewport($php_edit);    // note 1

      # test for a split-window like feature       // note 9
      $scrolled_win = new GtkScrolledWindow();
      $scrolled_win->set_policy(
        Gtk::POLICY_AUTOMATIC,
        Gtk::POLICY_AUTOMATIC);
 
      $vbox->add2($scrolled_win);
        $scrolled_win->add_with_viewport($php_edit->split());   // note 9

$win->set_size_request(400, 600);
$win->maximize();
$win->set_position(Gtk::WIN_POS_CENTER);

$win->show_all();
$win->set_title("PhpEditWidget - demo");
$win->connect_simple("destroy", array("Gtk", "main_quit"));
	  Gtk::main();

   }
   
  function destroy() {
	Gtk::main_quit();
  }
  
  function close_window($widget) {
	$window = $widget->get_toplevel();
	$window->hide();
  }     
   
   function there_is_code() {
   
     //$code = @file_get_contents("code.txt");
	 
	 $window = $this->window;
   
     if ($code = @file_get_contents("code.txt")) {
	   //echo $code,'zzz';
	   $parts = explode("\r\n<-->\r\n",$code);
	   //print_r($parts);
	   foreach ($parts as $chunk) {
	   
	     if (trim($chunk)) {
           $this->errors = array();//reset errors
           $orig_hndl = set_error_handler(array(&$this,"error_hndl"));
           eval($chunk);
           restore_error_handler();		 

		   /*if (count($this->errors)>0)  {
             echo 'Caught GTK CODE error ', "\n";
             $dialog = new GtkMessageDialog($this->window, Gtk::DIALOG_MODAL | Gtk::DIALOG_DESTROY_WITH_PARENT,
                        Gtk::MESSAGE_INFO, Gtk::BUTTONS_OK,
                        sprintf(var_dump($this->errors)));
             $dialog->run();
             $dialog->destroy();
		   }*/
         }			   	 
	   }  
	 }	
	 
	 //after code running... get new posted code or delete runned code
	 if (is_file("code.bee")) {
	   copy("code.bee","code.txt");
	   unlink("code.bee");
	 }
	 else
	   @unlink("code.txt");		      
	 
	/* eval("new EntryCompletion();
         Gtk::main();	");*/
		 
	 return true;//for timeout hack purpose	 
   }
   
   function error_hndl($errno, $errstr) {
     $this->errors[] = array("errno"=>$errno, "errstr"=>$errstr);
   } 
   
   function event_queue($event,$param="") {   
   
     echo $event,$param,"\n";
	 
	 if ($this->standalone) {
	   //communicate with local files (writing...) reading from server
	   echo 'files mode',"\n";
	 }
	 else {
	   //execute directly
	   echo 'direct mode',"\n";
	   $this->env->get_agent($param)->$event();
	 }
   }
}

class WindowTest extends GtkWindow
{
    function __construct($env=null)
    {
        parent::__construct();
		require_once("phpdac5://{$env->phpdac_ip}:{$env->phpdac_port}/agents/WidgetEditor.lib.php");

        $this->set_default_size(200,200);
        $this->set_title('GtkWindow demo');
        $this->connect_simple('destroy', array('gtk', 'main_quit'));
        $this->add($this->__create_box());
        $this->show_all();
    }

    function __create_box() 
    {
        $vbox = new GtkVBox();
        $label = new GtkLabel('Window test');
        $button = new GtkButton('Click the button!');

        $vbox->pack_start($label);
        $vbox->pack_start($button);

        $editor = new WidgetEditor(
            $this, 
            array(
                array('decorated'           , GtkToggleButton::gtype),
//                array('has_frame'         , GtkToggleButton::gtype),//doesn't work after the window is realized
                array('resizable'           , GtkToggleButton::gtype),
                array('skip_pager_hint'     , GtkToggleButton::gtype),
                array('skip_taskbar_hint'   , GtkToggleButton::gtype),
                array('accept_focus'        , GtkToggleButton::gtype),
                array('modal'               , GtkToggleButton::gtype),
                array('keep_above'          , GtkToggleButton::gtype, 'on', 'off', false),
                array('keep_below'          , GtkToggleButton::gtype, 'on', 'off', false),

                array('iconify'             , GtkButton::gtype, 'deiconify'),
                array('fullscreen'          , GtkButton::gtype, 'unfullscreen'),
                array('maximize'            , GtkButton::gtype, 'unmaximize'),
                array('stick'               , GtkButton::gtype, 'unstick'),

                array('present'             , GtkButton::gtype),
            )
        );

        return $vbox;
    }
}




class PhpEditWidget extends GtkSourceView {  // Note 1
  protected $buffer;                        // note 5
  protected $lang;
  protected $mime_lang;

  function __construct() {
    parent::__construct();  // note 2

    # default lang
    $this->mime_lang = 'text/x-php-source';    // note 3
    $this->set_lang($this->mime_lang);        // note 3

    $this->buffer = new GtkSourceBuffer();     // note 4, note 5
    $this->set_buffer($this->buffer);              // note 4

    $this->set_show_line_numbers(true);
    $this->set_show_line_markers(true);

    $this->buffer->set_language($this->lang);
    $this->buffer->set_highlight(true);
  }

  protected function set_lang($mime_type) {      // note 3
    $lang_manager = new GtkSourceLanguagesManager();
    $this->lang = $lang_manager->get_language_from_mime_type($mime_type);
  }

  public function load_file($file) {    // note 6
    if (!file_exists($file))
      return false;

    $lines = file_get_contents($file);

    $this->buffer->begin_not_undoable_action();  // note 8
    $this->buffer->set_text($lines);   // note 7
    $this->buffer->end_not_undoable_action();   // note 8
    return true;
  }

  function split() {                               // note 9
    $edit = new PhpEditWidget();
    $edit->set_buffer($this->get_buffer());
    return $edit;
  }
} // end of class PhpEditWidget

?>