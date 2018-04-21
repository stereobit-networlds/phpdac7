<?php

class LeetHelloDecorator extends HelloDecorator
{
	public function writeText($text)
	{
		$text = strtolower($text);
		$text = strtr($text, "oesaig", "035416");
		$this->_messageWriter->writeText($text);
	}
}
?>