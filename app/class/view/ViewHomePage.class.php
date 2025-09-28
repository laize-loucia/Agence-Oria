<?php

namespace view;

use controller\agency\ProjectController;
use controller\AppController;
use model\data\DataManager;
use view\agency\ProjectCardView;

/**
 * A View object that builds the base of the website's HMI as text in HTML format.
 * Automatically builds every needed tag for a generic page.
 */
class ViewHomePage extends ViewGenericPage {

	protected const CONTACT_SECTION_IN_PAGE = true;

	public function buildHeadContent(): string {
		$r = parent::buildHeadContent();
		$r.="<link rel=\"stylesheet\" href=\"public/css/vp-index.css\" />";
		$r.="<script src=\"public/js/index_landing_fg_bg.js\"></script>";
		$r.="<script src=\"public/js/index_landing_lettersHeadband.js\"></script>";
		$r.="<script src=\"public/js/team_carrousel.js\"></script>";
		$r.="<script src=\"public/js/projets_cards_3d.js\"></script>";
		$r.="<script src=\"public/js/services_selector.js\"></script>";
		$r.="<script src=\"public/js/contact_submit_ajax.js\"></script>";
		return $r;
	}

	public function buildMainContent(): string {
		$r = "";
		$r.=$this->buildLandingSection();
		$r.=$this->buildStorySection();
		$r.=$this->buildTeamSection(); // TO DO: activate!!!
		$r.=$this->buildProjectsSection();
		$r.=$this->buildServicesSection();
		$r.=$this->buildContactSection();
		return $r;
	}
	public function buildLandingSection(): string {
		$r = "";
		$r.="<section id=\"landing\">";
		$r.="<div class=\"foreground\"></div>";
		$r.="<div class=\"background\"></div>";
		$r.="<div id=\"lettersHeadband\" class=\"prevent-select\">";
		$r.="<div class=\"wrapper\">";
		$r.="<div class=\"lettersColumn\">";
		for ($i=0; $i<3; $i++) {
			$r.="<p>O</p><p>R</p><p>I</p><p>A</p>";
		}
		$r.="</div>";
		$r.="</div>";
		$r.="</div>";
		$r.="<div class=\"content\">";
		$r.="<h1>";

		$r.=$this->chooseStrLang([
			'fr' => "Concevoir & innover",
			'en' => "Design & innovate"
		]);
		
		$r.="<br />";
		
		$r.=$this->chooseStrLang([
			'fr' => "au-delà de l'ordinaire",
			'en' => "beyond the ordinary"
		]);
		

		$r.="</h1>";
		$r.="<p>";

		
		$r.=$this->chooseStrLang([
			'fr' => "Chez Oria, nous transformons vos idées en solutions digitales uniques.",
			'en' => "At Oria, we turn your ideas into unique digital solutions."
		]);
		$r.="<br />";
		$r.=$this->chooseStrLang([
			'fr' => "Avec un design percutant et des technologies innovantes, nous allons au-delà de l'ordinaire pour créer des expériences mémorables.",
			'en' => "With striking design and innovative technologies, we go beyond the ordinary to create memorable experiences."
		]);
		$r.="</p>";
		$r.="<p>";
		$r.=$this->chooseStrLang([
			'fr' => "Découvrez comment nous pouvons donner vie à vos ambitions.",
			'en' => "Find out how we can bring your ambitions to life."
		]);
		$r.="</p>";
		//$r.="<a class=\"hoverable-btn-1\" href=\"contact.html\">";
		$r.="<a class=\"hoverable-btn-1\" href=\"#contact\">";
		$r.="<div class=\"btn-launch\">";
		$r.=$this->chooseStrLang([
			'fr' => "Lancez votre projet",
			'en' => "Launch your project"
		]);
		$r.="</div>";
		$r.="</a>";
		$r.="</div>";
		$r.="</section>";
		return $r;
	}
	public function buildStorySection(): string {
		$r = "";
		$r.="<section id=\"agencyStory\">";
		$r.="<div class=\"content\">";
		$r.="<div class=\"story\">";
		$r.="<div class=\"text\">";
		$r.="<h2>";
		$r.=$this->chooseStrLang([
			'fr' => "Histoire d'Oria",
			'en' => "Oria history"
		]);
		$r.="</h2>";
		$r.="<p>";
		$r.=$this->chooseStrLang([
			'fr' => "Chez Oria, nous transformons chaque idée en une <strong>expérience digitale unique</strong>. Guidés par la <strong>créativité</strong>, l'<strong>innovation</strong> et l’excellence, nous créons des solutions interactives et immersives pour les <strong>marques ambitieuses</strong>. Avec une équipe de talents multidisciplinaires, nous combinons design, stratégie digitale et technologie de pointe pour donner vie à vos projets.",
			'en' => "At Oria, we turn every idea into a <strong>unique digital experience</strong>. Guided by <strong>creativity</strong>, <strong>innovation</strong> and excellence, we create interactive and immersive solutions for <strong>ambitious brands</strong>. With a team of multidisciplinary talents, we combine design, digital strategy and cutting-edge technology to bring your projects to life."
		]);
		$r.="<br/>";
		$r.=$this->chooseStrLang([
			'fr' => "Notre mission ? Aller <strong>au-delà de l'ordinaire</strong> et créer des expériences captivantes.",
			'en' => "Our mission? Going <strong>beyond the ordinary</strong> and creating captivating experiences."
		]);
		$r.="</p>";
		$r.="</div>";
		$r.="<div class=\"btn-launch-wrapper\">";
		$r.="<a href=\"#projects\" class=\"btn-launch black\">";
		$r.="<p class=\"value\">";
		$r.=$this->chooseStrLang([
			'fr' => "Découvrir nos projets",
			'en' => "Discover our projects"
		]);
		$r.="</p>";
		$r.="<div class=\"background\"></div>";
		$r.="</a>";
		$r.="</div>";
		$r.="</div>";
		$r.="<section id=\"keyNumbers\">";
		$r.="<h3>";
		$r.=$this->chooseStrLang([
			'fr' => "En 2024 chez Oria",
			'en' => "In 2024 at Oria"
		]);
		$r.="</h3>";
		$r.="<div class=\"listedNumbers\">";
		$r.="<div id=\"keyNumber-partners\" class=\"keyNumber\">";
		$r.="<p>";
		$r.="10";
		$r.="</p>";
		$r.="<p>";
		$r.=$this->chooseStrLang([
			'fr' => "collaborateurs",
			'en' => "co-workers"
		]);
		$r.="</p>";
		$r.="</div>";
		$r.="<div id=\"keyNumber-clients\" class=\"keyNumber\">";
		$r.="<p>";
		$r.="34";
		$r.="</p>";
		$r.="<p>";
		$r.=$this->chooseStrLang([
			'fr' => "clients",
			'en' => "customers"
		]);
		$r.="</p>";
		$r.="</div>";
		$r.="<div id=\"keyNumber-turnover\" class=\"keyNumber\">";
		$r.="<p>";
		$r.="11.7 M €";
		$r.="</p>";
		$r.="<p>";
		$r.=$this->chooseStrLang([
			'fr' => "de chiffre d'affaires",
			'en' => "in turnover"
		]);
		$r.="</p>";
		$r.="</div>";
		$r.="</div>";
		$r.="</section>";
		$r.="</div>";
		$r.="<div class=\"timeline\">";
		$r.="<img src=\"public/img/agency-story-timeline-" . $this->getLanguage() . ".svg\" alt=\"Notre histoire depuis 2024\" />";
		$r.="</div>";
		$r.="</section>";
		return $r;
	}
	public function buildTeamSection(): string {
		$r = "";
		$r.="<section id=\"team\">";
			$r.="<h2>";
				$r.=$this->chooseStrLang([
					'fr' => "Découvrir la dream team",
					'en' => "Discover the dream team"
				]);
			$r.="</h2>";
			$lang = $this->getLanguage();
			$r.="<div class=\"carrousel\">";
				$r.="<div class=\"carrousel-track\">";
					$r.="<div class=\"slide1\">";
						$r.="<img src=\"public/img/team-card-adam-$lang.webp\" alt=\"Adam Sansone\">";
						$r.="<img src=\"public/img/team-card-cyrielle-$lang.webp\" alt=\"Cyrielle Carvalheiro\">";
						$r.="<img src=\"public/img/team-card-kellya-$lang.webp\" alt=\"Kellya Soulé\">";
						$r.="<img src=\"public/img/team-card-david-$lang.webp\" alt=\"David Goncalves\">";
					$r.="</div>";
					$r.="<div class=\"slide2\">";
						$r.="<img src=\"public/img/team-card-juan-$lang.webp\" alt=\"Juan Villefose\">"; // TO DO: vérifier les noms dans les alt
						$r.="<img src=\"public/img/team-card-linh-$lang.webp\" alt=\"Linh Nguyen\">";
						$r.="<img src=\"public/img/team-card-loucia-$lang.webp\" alt=\"Loucia Laize\">";
						$r.="<img src=\"public/img/team-card-merwane-$lang.webp\" alt=\"Merwan [...]\">";
					$r.="</div>";
					$r.="<div class=\"slide3\">";
						$r.="<img src=\"public/img/team-card-solan-$lang.webp\" alt=\"Solan Minos\">";
						$r.="<img src=\"public/img/team-card-tiffany-$lang.webp\" alt=\"Tiffany Devaux\">";
						//$r.="<img src=\"public/img/team-card-pdg-$lang.webp\" alt=\"PDG\">";
					$r.="</div>";
				$r.="</div>";
				$r.="<button class=\"carrousel-btn prev\">";
					$r.="<img src=\"public/img/icon-arrow-right-2.svg\" alt=\"Précédent\">";
					/*$r.="<i class=\"fas fa-arrow-left\">";
					$r.="</i>";*/
				$r.="</button>";
				$r.="<button class=\"carrousel-btn next\">";
				$r.="<img src=\"public/img/icon-arrow-right-2.svg\" alt=\"Suivant\">";
					/*$r.="<i class=\"fas fa-arrow-right\">";
					$r.="</i>";*/
				$r.="</button>";
			$r.="</div>";
		$r.="</section>";
		return $r;
	}
	public function buildProjectsSection(): string {
		

		$r = "";
		$r.="<section id=\"projects\" class=\"preview\">";
			$r.="<h2>";
			$r.=$this->chooseStrLang([
				'fr' => "Projets",
				'en' => "Projects"
			]);
			$r.="</h2>";
			$r.="<div class=\"wrapper\">";
				$r.="<div class=\"wrapper-btn-more\">";
					$r.="<a class=\"decoratedItem-1 btn-more white afterico-right-arrow\" href=\"?#projects\">";
						$r.="<div class=\"wrapper decorationContainer\">";
							$r.="<p>";
								$r.=$this->chooseStrLang([
									'fr' => "Voir plus",
									'en' => "See more"
								]);
							$r.="</p>";
							$r.="<div class=\"itemDecoration\"></div>";
						$r.="</div>";
					$r.="</a>";
				$r.="</div>";
				$r.="<div class=\"project-row\">";

				foreach (ProjectController::getProjects(3) as $project) {
					$r.=new ProjectCardView($project);
				}

				$r.="</div>";
			$r.="</div>";
		$r.="</section>";
		return $r;
	}
	public function buildServicesSection(): string {
		$r = "";
		$r.="<section id=\"services\" class=\"preview\">";
			$r.="<h2>";
				$r.=$this->chooseStrLang([
					'fr' => "Nos services",
					'en' => "Our services"
				]);
			$r.="</h2>";
		$r.="<div class=\"subjects\">";

		$servicesTypesTitles = DataManager::loadData(
			DataManager::PATH_TO_JSON_FOLDER . 'servicesTypes.json'
		);
		foreach ($servicesTypesTitles as $key=>$serviceTitle) {
			$label = '[]';
			$labelKey = 'label-' . $this->getLanguage();
			if (isset($serviceTitle->$labelKey)) {
				$label = $serviceTitle->$labelKey;
			}
			$fieldName = '';
			if (isset($serviceTitle->field)) {
				$fieldName = $serviceTitle->field;
			}
			$iconFileName = '';
			if (isset($serviceTitle->iconFileName)) {
				$iconFileName = $serviceTitle->iconFileName;
			}
			
			$selectedValue = "";
			if ($key == 0) {
				$selectedValue = " selected";
			}
			
			$r.="<div id=\"subject-$fieldName\" class=\"item$selectedValue\">";
				$r.="<h4 class=\"subject-name\">";
					$r.=$label;
				$r.="</h4>";
				$r.="<svg class=\"icon-wrapper\" width=\"100%\" height=\"100%\" xmlns=\"http://www.w3.org/2000/svg\">";
					$r.="<defs>";
						$r.="<clipPath id=\"border-clip-1\">";
							$r.="<rect class=\"border-1\" width=\"0\" height=\"0\" />";
						$r.="</clipPath>";
					$r.="</defs>";
					$r.="<rect class=\"border-1\" clip-path=\"url(#border-clip-1)\" width=\"0\" height=\"0\" />";
					$r.="<image class=\"icon\" xlink:href=\"public/img/$iconFileName\" width=\"0\" height=\"0\" />";
				$r.="</svg>";
			$r.="</div>";
		}

		$r.="</div>";

		$r.="<div id=\"subjects-associated-btns\">";

		foreach ($servicesTypesTitles as $key=>$serviceTitle) {
			$fieldName = '';
			if (isset($serviceTitle->field)) {
				$fieldName = $serviceTitle->field;
			}
			
			$selectedValue = "";
			if ($key == 0) {
				$selectedValue = " selected";
			}
			
			$r.="<div class=\"field-$fieldName$selectedValue\">";

			if ((isset($serviceTitle->subServices)) && (is_array($serviceTitle->subServices))) {
				foreach ($serviceTitle->subServices as $subService) {
					
					$label = '';
					$labelKey = 'label-' . $this->getLanguage();
					if (isset($subService->$labelKey)) {
						$label = $subService->$labelKey;
					}
					$btnClass = '';
					if (isset($subService->btnClass)) {
						$btnClass = $subService->btnClass;
					}
					
					$r.="<a class=\"btn-$btnClass\" href=\"?" . AppController::GET_PARAM_NAME_VIEWPAGE . "=services\">";
					$r.="<p class=\"value\">";
					$r.=$label;
					$r.="</p>";
					$r.="<div class=\"icon-right-arrow\">";
					$r.="</div>";
					$r.="</a>";
				}

				$r.="</div>";
			}
		}

		$r.="</section>";
		return $r;
	}

}

?>
