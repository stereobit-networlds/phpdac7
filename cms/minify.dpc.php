<?php
if (!defined("MINIFY_DPC")) {
define("MINIFY_DPC",true);

$__DPC['MINIFY_DPC'] = 'minify';
//namespace Minify;

require_once(_r('cms/minify.lib.php'));

/**

// HTML Minifier
function minify_html(input) {
    return input
    .replace(/<\!--(?!\[if)([\s\S]+?)-->/g, "") // Remove HTML comments except IE comments
    .replace(/>[^\S ]+/g, '>')
    .replace(/[^\S ]+</g, '<')
    .replace(/>\s{2,}</g, '><');
}
// Test
alert(minify_html('<div>      <span><a href="">test</a> <span></span>\t</span>  \t\r\n\n\n\n\t\t       </div>'));


$str = file_get_contents('p­ath/to/style.css');
// echo
echo minify_css($str);
//­ save as `style.min.css`
file_put_contents('path­/to/style.min.css', minify_css($str));


<style>
<?php echo minify_css(file_get_contents('p­ath/to/style.css')); ?>
</style>

<script>
<?php echo minify_js(file_get_contents('p­ath/to/engine.js')); ?>
</script>


Example with Output Buffer
include 'path/to/php-html-css-js-minifier.php';
ob_start('minify_html');
<!-- HTML code goes here ... -->
<?php echo ob_get_clean(); ?>



*/

class minify {
	
	protected $path, $urlpath;
	
	/*
	public function __construct() { 

	}
	
	*/
	
	static public function cssMinify($css=null) {
		if (($css==null) || (strstr($css,'.min.css'))) 
			return null; //is min css
		
		$path = getcwd() . '/'; 
		$mincss = str_replace('.css','.min.css', $css);	
		
		if (is_file($path . $mincss)) {
			return ($mincss); //min.css string
		}	
		else {
			$str = @file_get_contents($path . $css);
			//echo $path . $mincss;
			//echo "<!-- minify css: $path $mincss created -->"; //minify_css($str);
			$ret = @file_put_contents($path . $mincss, minify_css($str));		
			
			return $ret ? $mincss : $css; //min.css string
		}
		
		return ($css);
	}	

	static public function jsMinify($js=null) {
		if (($js==null) || (strstr($js,'.min.js'))) 
			return null; //is min js
		
		$path = getcwd() . '/'; 
		$minjs = str_replace('.js','.min.js', $js);	
		
		if (is_file($path . $minjs)) {
			return ($minjs); //min.js string
		}	
		else {
			$str = @file_get_contents($path . $js);
			//echo "<!-- minify js: $path $minjs created -->"; 
			$ret = @file_put_contents($path . $minjs, minify_js($str));		
			
			return $ret ? $minjs : $js; //min.js string
		}
		
		return ($js);
	}

	static public function htmlMinify($html=null) {
		if (($html==null) || (strstr($html,'.min.html'))) 
			return null; //is min html
		
		$path = getcwd() . '/'; 
		$minh = str_replace('.htm','.min.html', $html); //.htm files	
		
		if (is_file($path . $minh)) {
			return ($minh); //min.html string
		}	
		else {
			$str = @file_get_contents($path . $html);
			//echo "<!-- minify html: $path $minh created -->"; 
			$ret = @file_put_contents($path . $minh, minify_html($str));		
			
			return $ret ? $minh : $html; //min.html string
		}
		
		return ($html);
	}	

};
}
?>