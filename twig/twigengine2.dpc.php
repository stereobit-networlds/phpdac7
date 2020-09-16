<?php
if (!defined("TWIGENGINE2_DPC")) {
define("TWIGENGINE2_DPC",true);

$__DPC['TWIGENGINE2_DPC'] = 'twigengine2';

//!!!!!!!!!!!!!!!!!!!!1 preload twig classes for phar inclusion
require_once(_r('twig/Twig/LoaderInterface.php'));
require_once(_r('twig/Twig/Loader/Filesystem.php'));
require_once(_r('twig/Twig/Environment.php'));
require_once(_r('twig/Twig/FilterInterface.php'));
require_once(_r('twig/Twig/Filter.php'));
require_once(_r('twig/Twig/Filter/Function.php'));
require_once(_r('twig/Twig/Environment.php'));
require_once(_r('twig/Twig/ExtensionInterface.php'));
require_once(_r('twig/Twig/Extension.php'));
require_once(_r('twig/Twig/Extension/Core.php'));
require_once(_r('twig/Twig/Extension/Escaper.php'));
require_once(_r('twig/Twig/Extension/Optimizer.php'));
require_once(_r('twig/Twig/LexerInterface.php'));
require_once(_r('twig/Twig/Lexer.php'));
require_once(_r('twig/Twig/ExpressionParser.php'));
require_once(_r('twig/Twig/ParserInterface.php'));
require_once(_r('twig/Twig/Parser.php'));
require_once(_r('twig/Twig/TokenParserInterface.php'));
require_once(_r('twig/Twig/TokenParser.php'));
require_once(_r('twig/Twig/TokenStream.php'));
require_once(_r('twig/Twig/TokenParserBrokerInterface.php'));
require_once(_r('twig/Twig/TokenParserBroker.php'));
require_once(_r('twig/Twig/Token.php'));
require_once(_r('twig/Twig/TokenParser/For.php'));
require_once(_r('twig/Twig/TokenParser/If.php'));
require_once(_r('twig/Twig/TokenParser/Extends.php'));
require_once(_r('twig/Twig/TokenParser/Include.php'));
require_once(_r('twig/Twig/TokenParser/Block.php'));
require_once(_r('twig/Twig/TokenParser/Use.php'));
require_once(_r('twig/Twig/TokenParser/Filter.php'));
require_once(_r('twig/Twig/TokenParser/Macro.php'));
require_once(_r('twig/Twig/TokenParser/Import.php'));
require_once(_r('twig/Twig/TokenParser/Set.php'));
require_once(_r('twig/Twig/TokenParser/Spaceless.php'));
require_once(_r('twig/Twig/TokenParser/From.php'));
require_once(_r('twig/Twig/TokenParser/AutoEscape.php'));
require_once(_r('twig/Twig/NodeInterface.php'));
require_once(_r('twig/Twig/NodeVisitorInterface.php'));
require_once(_r('twig/Twig/Node.php'));
require_once(_r('twig/Twig/NodeVisitor/Escaper.php'));
require_once(_r('twig/Twig/NodeVisitor/Optimizer.php'));
require_once(_r('twig/Twig/NodeVisitor/SafeAnalysis.php'));
require_once(_r('twig/Twig/NodeOutputInterface.php'));
require_once(_r('twig/Twig/Node/Text.php'));
require_once(_r('twig/Twig/Node/Set.php'));
require_once(_r('twig/Twig/Node/If.php'));
require_once(_r('twig/Twig/Node/For.php'));
require_once(_r('twig/Twig/Node/Module.php'));
require_once(_r('twig/Twig/Node/Expression.php'));
require_once(_r('twig/Twig/Node/Expression/Name.php'));
require_once(_r('twig/Twig/Node/Expression/AssignName.php'));
require_once(_r('twig/Twig/Node/Expression/Array.php'));
require_once(_r('twig/Twig/Node/Expression/Constant.php'));
require_once(_r('twig/Twig/Node/Expression/GetAttr.php'));
require_once(_r('twig/Twig/Node/Expression/Filter.php'));
require_once(_r('twig/Twig/Node/Print.php'));
require_once(_r('twig/Twig/TemplateInterface.php'));
require_once(_r('twig/Twig/Template.php'));
require_once(_r('twig/Twig/Node/Expression/Binary.php'));
require_once(_r('twig/Twig/Node/Expression/Binary/Mul.php'));
require_once(_r('twig/Twig/NodeTraverser.php'));
require_once(_r('twig/Twig/CompilerInterface.php'));
require_once(_r('twig/Twig/Compiler.php'));

//GetGlobal('controller')->_require('twig/twigengine.lib.php');
require_once(_r('twig/twigengine.lib.php'));
//GetGlobal('controller')->_require('twig/phpdac.dpc.php');
require_once(_r('twig/phpdac.dpc.php'));
	   
class twigengine2 extends Twig_Autoloader {

    var $prpath, $tpath, $tcache;
    var $twig;
    var $tmpl_path, $tmpl_name;
   
    var $pdac;
   
    function __construct($cache=false) {
   
        $this->prpath = paramload('SHELL','prpath');
		$this->tcache = paramload('SHELL','cachepath');
		
        $this->tpath = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);		
	    $this->tmpl_path = remote_paramload('FRONTHTMLPAGE','path',$this->prpath);
	    $this->tmpl_name = remote_paramload('FRONTHTMLPAGE','template',$this->prpath);	 		
		
		parent::register();
		
		$mypath = $this->tmpl_name ? 
		          // undefined $template //$this->prpath . $this->tmpl_path .'/'. $this->tmpl_name .'/'. str_replace('.',getlocal().'.',$template) :
				  $this->prpath . $this->tmpl_path .'/'. $this->tmpl_name .'/' :
		          $this->prpath . $this->tpath;

		$loader = new Twig_Loader_Filesystem($mypath);//'/path/to/templates');
		$c = ($cache) ? array('cache' => $this->tcache) : array();
		$this->twig = new Twig_Environment($loader, $c);
						   
						   
		$this->pdac = new phpdac();				   
		$this->twig->addGlobal('phpdac', $this->pdac);
		$this->twig->addFilter('nformat', new Twig_Filter_Function('phpdac::_nformat'));
		$this->twig->addFilter('nformatstr', new Twig_Filter_Function('phpdac::_nformatstr'));
		$this->twig->addFilter('nformatcdot', new Twig_Filter_Function('phpdac::_nformatcdot'));
		//$this->twig->addFilter('sexplode', new Twig_Filter_Function('phpdac::_sexplode'));
		$this->twig->addFilter('dacarray', new Twig_Filter_Function('phpdac::_dacarray'));
		//$this->twig->addFilter('dacelement', new Twig_Filter_Function('phpdac::_dacelement'));
		//$function = new Twig_SimpleFunction("dacelement", function ($id=0) { return (phpdac::_dacelement($id));});
        //$this->twig->addFunction($function);
		for ($xi=1;$xi<21;$xi++) 
		   $this->twig->addFilter('_'.$xi, new Twig_Filter_Function('phpdac::_'.$xi));
		
		$this->twig->addFilter('brstrstr', new Twig_Filter_Function('phpdac::_brstrstr'));
        //$this->twig->addFilter('lower', new Twig_Filter_Function('strtolower'));		
		//$this->twig->addFilter('monfiltre', new Twig_Filter_Function('MaClasse::MaMethode'));
		/*$function = new Twig_SimpleFunction("form_text", function ($name, $id, $value = "", $class = "form_text") {
        echo '<input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" class="'.$class.'">";
});
$twig->addFunction($function);*/
/*
$syntaxe = new Twig_Lexer($twig, array(
    'tag_comment'  => array('#', '#'),
    'tag_block'    => array('<%', '%>'),
    'tag_variable' => array('<%=', '%>')
));
$twig->setLexer($syntaxe);
*/
    }
   
    public function render($htmlpage=null, $cache=false, $mytokens=null) {
        if (!$htmlpage) return;
						   
        $tokens = unserialize($mytokens);
		$this->pdac->addTokens($tokens);
		$ret = $this->twig->render($htmlpage, $tokens);   
		
		return ($ret);
    }
   
    public static function tokenize($mytokens) {
       $tokens = unserialize($mytokens);
       if (empty($tokens)) return;
   
       return (implode('<twig|twig>',$tokens));
    }   

};
}