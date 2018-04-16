<?php
 
spl_autoload_register();
 
$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
 
echo "MessageWriter:\n";
$writer1 = new Message\MessageWriter();
$writer1->writeText($str);
echo "\n";
 
 
echo "GzCompressMessageWriterDecorator - MessageWriter:\n";
$writer2 = new Message\GzCompressMessageWriterDecorator( new Message\MessageWriter() );
$writer2->writeText($str);
echo "\n";
 
echo "GzCompressMessageWriterDecorator - Base64MessageWriterDecorator - MessageWriter\n";
$writer3 = new Message\GzCompressMessageWriterDecorator( new Message\Base64MessageWriterDecorator(new Message\MessageWriter()));
$writer3->writeText($str);
echo "\n";
 
echo "LeetMessageWriterDecorator - MessageWriter:\n";
$writer4 = new Message\LeetMessageWriterDecorator( new Message\MessageWriter());
$writer4->writeText($str);
echo "\n";
 
 
echo "Base64MessageWriterDecorator - LeetMessageWriterDecorator - MessageWriter:\n";
$writer5 = new Message\Base64MessageWriterDecorator(new Message\LeetMessageWriterDecorator( new Message\MessageWriter()));
$writer5->writeText($str);
echo "\n";
?>