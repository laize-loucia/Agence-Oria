<?php

namespace model\factory;

use view\View;

/**
 * Contains modules that handles views' creation (or settings).
 */
class ViewPageFactory {
	
	/**
	 * Factory object stored in a static property (singleton).
	 */
	protected static $_instance;
	/**
	 * Names of the enabled view/pages.
	 * 	( = class name without the "View" prefix and the "Page" suffix )
	 * 	( should be initiated with ->initPossibleViewPages() )
	 */
	protected $arrayViewPageNames = [];

	protected const DEFAULT_VIEW_PAGE_NS = 'view\\';
	protected const DEFAULT_VIEW_PAGE_PREFIX = 'View';
	protected const DEFAULT_VIEW_PAGE_NAME = 'Home';
	protected const DEFAULT_VIEW_PAGE_SUFFIX = 'Page';
	protected const DEFAULT_VIEW_PAGE_CLASSNAME = self::DEFAULT_VIEW_PAGE_PREFIX . self::DEFAULT_VIEW_PAGE_NAME . self::DEFAULT_VIEW_PAGE_SUFFIX;
	protected const DEFAULT_VIEW_PAGE_FULL_CLASSNAME = self::DEFAULT_VIEW_PAGE_NS . self::DEFAULT_VIEW_PAGE_CLASSNAME;

	/**
	 * Instanciates the factory (so that non-static properties can be used), and calls ->initPossibleViewPages().
	 */
	public function __construct() {
		$this->initPossibleViewPages();
	}
	
	/**
	 * Gets the factory as an object, and can be called all along the program to get the same object with the same properties (singleton).
	 * 
	 * @return ViewPageFactory
	 */
	public static function getInstance() {
		if(self::$_instance === null){
			self::$_instance = new ViewPageFactory();
		}
		return self::$_instance;
	}
	
	/**
	 * Changes the value of ->arrayViewPageNames only if it isn't already set.
	 * 	(why? - idk)
	 * 
	 * @param array $arrayViewPageNames Array of strings, representing the names of the view/pages
	 * 
	 * @return void
	 */
	public function setArrayViewPageNames($arrayViewPageNames) {
		
		if(($this->arrayViewPageNames === null) or ($this->arrayViewPageNames==array())){
			$this->arrayViewPageNames = $arrayViewPageNames;
		}
		
	}
	
	/**
	 * Inits the accessible view/pages by setting the ->arrayViewPageNames, after checking through the files all the view class files available.
	 * 
	 * @return void
	 */
	public function initPossibleViewPages() {
	  $arrayPossibleViewPages = array();
	    
		$appViewPageFiles = scandir(ROOT . "/app/class/view");		
		//$coreViewPageFiles = scandir(ROOT . "/core/class/view");
		//$viewPageFiles = array_merge($appViewPageFiles, $coreViewPageFiles);
		$viewPageFiles = $appViewPageFiles;
		foreach($viewPageFiles as $fileName) {
				if((preg_match("/^View/", $fileName)) and (preg_match("/Page.class.php$/", $fileName))){        
				$className = $fileName;
					$className = str_replace("View", "", $className);
					$className = str_replace("Page.class.php", "", $className);
						array_push($arrayPossibleViewPages, $className);
				}
		}
		
		$this->setArrayViewPageNames($arrayPossibleViewPages);
	}
	
	
	
	/**
	 * Instanciates and returns a view/page (such as ViewGenericPage (which is the default view returned)).
	 * 	(If req=="graph", $_GET["title"] should contain the name of the requested graph)
	 * 	(If req=="graph" and the requested graph doesn't exist, a ViewGraphNotFoundPage is returned).
	 * 	(Uses self::DEFAULT_VIEW_PAGE_NAME and self::DEFAULT_VIEW_PAGE_ACTION, and builds the $viewPageName either as default with this class' constants plus the $name param)
	 * 
	 * @param ?string $name Name of the requested view/page.
	 * 
	 * @return View
	 */
	public function getViewPage(?string $name=null): View {
		if(!(isset($name))){
 			$name=self::DEFAULT_VIEW_PAGE_NAME; }
		$viewPageName = ucfirst($name);
		if(!(in_array($viewPageName, $this->arrayViewPageNames))){
			$viewPageName = $name;
			if(!(in_array($viewPageName, $this->arrayViewPageNames))){
				$viewPageName = self::DEFAULT_VIEW_PAGE_NAME;	
			}
		}
		$className = self::DEFAULT_VIEW_PAGE_NS
			. self::DEFAULT_VIEW_PAGE_PREFIX
			. $viewPageName
			. self::DEFAULT_VIEW_PAGE_SUFFIX;
		/*switch($name){
			case "Graph":
				$graph = null;
				$title = null;
				if((isset($_GET['title']))){
					$title = $_GET['title'];
					$graph = GraphFactory::getGraphWithGraphName($title);
				}
				if(isset($graph)){
					return new $className($graph);
				}
				return new ViewGraphNotFoundPage($title);
				break;
		}*/
		//$className = self::DEFAULT_VIEW_PAGE_FULL_CLASSNAME;
		return new $className();
	}
		
}

?>
