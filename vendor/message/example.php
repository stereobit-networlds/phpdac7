<?php
//http://drib.tech/programming/decorator-pattern 
spl_autoload_register();
 
$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
 
echo "MessageWriter:\n";
$writer1 = new Message\MessageWriter();
$writer1->writeText($str);
echo "\n";
?>