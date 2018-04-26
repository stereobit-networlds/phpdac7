<?php

class say {
	
	public function __construct(& $env) {

		$immX = ImmutableC::create()
							->set('test', 'a string goes here:' . $data)
							->set('another', 100)
							->arr([1,2,3,4,5,6])
							->arr(['a' => 1, 'b' => 2])
							->build();
		//echo 'async:' . $immX . PHP_EOL;		
		
		//echo "Async - MessageWriter:\n";
		$str='Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus congue lectus, nec interdum erat ornare nec. Nunc tincidunt lobortis augue at vehicula.';
		
		//array_shift($env->_stack); //exclude self 'async' call
		if ($etl = $env->runETL($env->_stack))
		{
			//ETL output
			echo "Output:\n";
			$etl->writeText($str, $immX) . PHP_EOL;
		}		
		return $immX;	
		//return false;	
	}
}
?>