<?php

namespace controller;
use view\View;
use model\factory\ViewFactory;

/**
 * Parent controller of the whole program.
 * 
 * It has all the caracteristics shared between all imaginable controllers.
 * Since I (the intern) didn't think of a good division of the controllers, everything is in this class.
 */
class Controller {
	
	/**
	 * Controller object stored in a static property (singleton).
	 */
	protected static $_instance;

	/**
	 * Gets the controller as an object, and can be called all along the program to get the same object with the same properties (singleton).
	 * 
	 * @return Controller
	 */
	public static function getInstance() {
		if(self::$_instance===null){
			$className = get_called_class(); // to get the type of controller that has been requested
			self::$_instance = new $className();
		}
		return self::$_instance;
	}
	
}

?>
