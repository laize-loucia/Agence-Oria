<?php

namespace model;

use DefaultConsts;
use StyleConsts;

/**
 * The Constants class is the abstract class you need to refer to in order to acces any constant value, as well a public repositories source paths.
 * It implements multiple interfaces that are only used to keep constant values so that all of them are accessible through only one class. Additionnaly, you can link as much interfaces as you want ; use this to divide your code by categories and modules!
 */
abstract class Constants {
	//abstract class JN_Constants implements DefaultConsts, StyleConsts {
	
	// Used outside of test.nobecourt.fr
	/*public const REP_CSS = "public/css";
	public const REP_JS = "public/js";
	public const REP_IMG = "public/img";
	public const REP_FONT = "public/font";*/
	
	// Used inside of test.nobecourt.fr
	/**
	 * Complete repository path to ./public/css
	 */
	public const REP_CSS = ROOT . "/public/css";
	/**
	 * Complete repository path to ./public/js
	 */
	public const REP_JS = ROOT . "/public/js";
	/**
	 * Complete repository path to ./public/img
	 */
	public const REP_IMG = ROOT . "/public/img";
	/**
	 * Complete repository path to ./public/font
	 */
	public const REP_FONT = ROOT . "/public/font";




	/**
	 * Tag (string) used at the start of a HTML document.
	 */
	public const XML_TAG_DOCTYPE_HTML_STR_FULL = "<!DOCTYPE html>";
    
	/**
	 * Name of the website, being the first part of the <title>
	 */
	public const TITLE_VALUE_START_GENERIC = 'Agence Oria';
	/**
	 * Separator in the <title> tag between the name of the website and the info about the selected page.
	 */
	public const TITLE_VALUE_SEPARATOR_GENERIC = ' | ';
	/**
	 * Text indicating being on the home page, being the second part of the <title>.
	 */
	public const TITLE_VALUE_END_DEFAULT = 'Accueil';
	public const TITLE_VALUE_END_SERVICES = 'Services';






	
	
	/**
	 * Returns the complete path to a repository by returning the class constant related to the requested folder name.
	 * 	(REP_CSS/REP_JS/REP_IMG/REP_FONT)
	 * 
	 * @param string $name Name of the target repository, that should be "CSS"/"JS"/"IMG"/"FONT".
	 * @param bool $endSlash Optional parameter (default is false) used in case we want to add a slash at the end of the returned path.
	 * 
	 * @return string
	 */
	public static function getRepository(string $name, bool $endSlash=false): string {
		$constName = "REP_" . strtoupper($name);
		$r = constant("self::$constName");
		$r = explode($_SERVER['SERVER_NAME'], $r);
		$r = end($r);
		$r = str_replace('\\', '/', $r);
		if($endSlash){
			$r.="/";
		}
		return $r;
	}
	
}

?>
