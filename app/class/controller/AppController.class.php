<?php

namespace controller;

use view\View;
use model\factory\ViewPageFactory;
use model\mail\MailingManager;

/**
 * Parent controller of the whole program.
 * 
 * It has all the caracteristics shared between all imaginable controllers.
 * Since I (the intern) didn't think of a good division of the controllers, everything is in this class.
 */
class AppController extends Controller {

	public const ACTION_CHOOSE_VIEW = 0; // req
	public const ACTION_SEND_MAIL = 1; // req
	
	public const ACTION_CHECK_MAIL_SENT = 0; // res
	public const ACTION_HEADER_LOCATION_HOME = 0; // hl

	public const GET_PARAM_NAME_ACTION_REQUEST = 'req';
	public const GET_PARAM_NAME_RESPONSE_REQUEST = 'res';
	public const GET_PARAM_NAME_VIEWPAGE = 'vp';
	public const GET_PARAM_NAME_HEADER_LOCATION = 'hl';

	public const AVAILABLE_LANGUAGES = [ 'fr', 'en' ];

	public function __construct() {
		$this->updateSessionIfNeeded();
	}


	/**
	 * [Overrided for IDE autocompletion]
	 *  TO DO: remove overriding!!!!
	 */
	public static function getInstance(): AppController {
		if(self::$_instance===null){
			$className = get_called_class(); // to get the type of controller that has been requested
			self::$_instance = new $className();
		}
		return self::$_instance;
	}




	public function updateSessionIfNeeded() {
		if ((isset($_GET['lang'])) && (in_array($_GET['lang'], $this::AVAILABLE_LANGUAGES))) {
			$_SESSION['oria_lang'] = $_GET['lang'];
		}
	}



	
	public function chooseAction(): void {
		$request = $this::ACTION_CHOOSE_VIEW;
		$paramName = $this::GET_PARAM_NAME_ACTION_REQUEST;
		if((isset($_GET[$paramName])) && ($_GET[$paramName]!=="")){
			$request = $_GET[$paramName];
		}
		$this->applyRequestedAction($request);
	}

	public function applyRequestedAction(mixed $request): void {
		switch ($request) {
			case $this::ACTION_SEND_MAIL:
				MailingManager::tryActContact();
				break;
			case $this::ACTION_CHOOSE_VIEW:
			default:
				echo $this->chooseView();
				break;
		}
		$paramName = $this::GET_PARAM_NAME_HEADER_LOCATION;
		if((isset($_GET[$paramName])) && ($_GET[$paramName]==$this::ACTION_HEADER_LOCATION_HOME)){
			header("Location: ?");
		}
	}


	
	/**
	 * Automatically returns the right view depending on multiple global parameters, such as the $_GET array variable.
	 * 	The value of "req" defines the view name, but the class name can be completed with an optional "action" key (ex: $_GET["req"] = "graph" && $_GET["action"] = "edit")
	 * 	Calls the ViewPageFactory's ->getViewPage() method, with the view name and the action applied to the view.
	 * 
	 * @return View
	 */
	public function chooseView(): View {
		$view = null;

		$paramName = $this::GET_PARAM_NAME_VIEWPAGE;
		$viewPageName = null;
		if((isset($_GET[$paramName])) && ($_GET[$paramName]!=="")){
			$viewPageName = $_GET[$paramName];
		}
		$view = ViewPageFactory::getInstance()->getViewPage(
			$viewPageName
		);
		
		return $view;
	}

	
	
}

?>
