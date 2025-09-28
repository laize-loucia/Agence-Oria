<?php

namespace view;

/**
 * A View object that builds the website's HMI used when an error occurs while going through the code.
 * Simple ViewGenericPage with a custom message in the main element.
 */
class ViewErrorPage extends ViewGenericPage {

	/**
	 * Message displayed in the "main" element, giving information about what made the error occur.
	 */
  protected $errorMessage = 'The website has encountered a problem.';
	
	public function buildMainContent(): string {
		$r = "";
		$r.=$this->buildErrorMessage();
		return $r;
	}

	public function buildErrorMessage(): string {
		$r = "";
		$r.=$this->errorMessage . "\n";
		return $r;
	}

	

}

?>