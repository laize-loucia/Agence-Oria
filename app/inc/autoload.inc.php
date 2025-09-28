<?php

namespace App;

/**
 * Registers the autoloader of this "app" folder.
 * 
 * @return void
 */
function register(){
	if(defined("LOAD_AUTOLOAD")){
		spl_autoload_register(__NAMESPACE__ . '\autoload');
	}else{
		die();
	}
}

/**
 * Defines the way to handle the autoload of classes throughout the ./app/class/ folder. (Requires the file if found)
 * 
 * @param string $class Class name to be located in a file with ".class.php".
 * 	Can include a namespace.
 * 
 * @return void
 */
function autoload($class){
	//$class = str_replace("\\", "/", $class);
	$pathToClassFile = ROOT . "/app/class/$class.class.php";
	$pathToClassFile = str_replace("\\", "/", $pathToClassFile);
	if(file_exists($pathToClassFile)){
		//var_dump($pathToClassFile);
		require($pathToClassFile);
	}
}

?>
