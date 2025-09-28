<?php
/**
 * Starting file of the program.
 * 
 * Defines the needed main constants (ROOT, LOAD_AUTOLOAD...).
 * Starts the session.
 * Does the very first call to the Controller (there could also be here a few conditions to choose the controller).
 * 
 * Can lead to echoing a webpage or do some other action (such as sending a mail).
 */

use controller\AppController;

error_reporting(E_ALL);
ini_set('display_errors', '1');

define("ROOT", __DIR__);
define("LOAD_AUTOLOAD", true);

$separator = '/';
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
  $separator = '\\';
}
define("DIR_SEPARATOR", $separator);


// Allow calling any set class from this moment thanks to the autoloader
require_once(ROOT . '/app/inc/autoload.inc.php');
App\register();

// The session should (apparently) start after loading ALL of the classes that might be used
session_start();



// --------------------------

//echo "<pre>";

//echo "</pre>";


?>
