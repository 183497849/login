<?php
	function __autoload($class) {
		if (strpos($class, "Controller") !== false) {
			$dir = 'controller';
		} elseif (strpos($class, "Model") !== false) {
			$dir = 'model';
		} else {
			die($class."not exist");
		}
		include "./{$dir}/{$class}.class.php";
	}

	function L($name){
		include "./library./$name.class.php";
		$obj = new Upload();
		return $obj;
	}
	function getRandom($len){
		$base="123456789asdfgh";
		$max = strlen($base);
		mt_rand();
		$rand='';
		for($i=0;$i<$len;$i++){
			$rand .=$base[mt_rand(0,$max-1)];
		}
		return $rand;
	} 