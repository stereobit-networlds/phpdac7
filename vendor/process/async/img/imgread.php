<?php
class imgread implements xmlnodeInterface
{
	public function xmltnode($node, &$conf)
	{		
		//$imgurl = $node->url;
		$file = $node->attributes()->filename;
		if (is_readable($conf->imgfolder . $file))
			return null;
		
		return @file_get_contents($node->url);
	}
}
?>