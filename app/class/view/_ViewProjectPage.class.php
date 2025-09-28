<?php

namespace view;

use controller\agency\BenefitController;
use controller\agency\FeatureController;
use controller\agency\ProjectController;
use model\Constants;
use view\agency\BenefitView;
use view\agency\FeatureView;
use view\agency\ProjectInRowListView;

/**
 * A View object that builds the base of the website's HMI as text in HTML format.
 * Automatically builds every needed tag for a generic page.
 */
class _ViewProjectPage extends ViewGenericPage {

	/*protected $project;

	public function __construct($project) {
		$this->project = $project;
	}*/
	
	public function getPageTitleEnd(): string {
		return Constants::TITLE_VALUE_SEPARATOR_GENERIC . Constants::TITLE_VALUE_END_SERVICES;
	}

	public function buildHeadContent(): string {
		$r = parent::buildHeadContent();
		$r.="<link rel=\"stylesheet\" href=\"public/css/project.css\" />";
		$r.="<link rel=\"stylesheet\" href=\"public/css/common.css\" />";
		$r.="<link rel=\"stylesheet\" href=\"public/css/bodyHeaderFooter.css\" />";
		return $r;
	}

	public function buildMainContent(): string {
		$r = "";
		$r.=$this->buildLandingSection();
		return $r;
	}
	public function buildLandingSection(): string {
		$r = "";
		$r.="<section id=\"landing\">";
			$r.="<h2>";
				$r.="Project";
			$r.="</h2>";
		$r.="</section>";
		return $r;
	}

}

?>
