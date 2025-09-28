<?php
/**
 * Starting file of the program.
 * 
 * Defines the needed main constants (ROOT, LOAD_AUTOLOAD...).
 * Starts the session.
 * Does the very first call to the Controller (there could also be here a few conditions to choose the controller).
 * 
 * Can also be included from one of the PHP scripts in the ./ajax/ folder by defining ENABLE_DEFAULT as false.
 */

use controller\agency\ProjectController;
use controller\AppController;
use model\Constants;
use model\factory\ViewPageFactory;
use view\agency\ProjectInRowListView;

error_reporting(E_ALL);
ini_set('display_errors', '1');

define("ROOT", __DIR__);
define("LOAD_AUTOLOAD", true);


require_once(ROOT . '/app/inc/autoload.inc.php');
App\register();

// The session has to start after loading ALL of the classes that might be used in the ajax scripts
session_start();

// -----------------------



//echo "<pre>";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$project = ProjectController::getProjectWithId($id);
	if (isset($project)) {
		$projectView = new ProjectInRowListView(
			$project
		);
		//echo $projectView;
		if (isset($project->label)) {
			var_dump($project->label);
		}
	}
}
//echo "</pre>";


//$maVue = new ViewProjectPage();
//echo $maVue;

?>
