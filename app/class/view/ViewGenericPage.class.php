<?php

namespace view;

use controller\AppController;
use model\data\DataManager;

/**
 * A View object that builds the base of the website's HMI as text in HTML format.
 * Automatically builds every needed tag for a generic page.
 */
class ViewGenericPage extends ViewHtml {

	protected const HREF_VALUE_VIEWPAGE_HOME =  "?";
	protected const HREF_VALUE_VIEWPAGE_SERVICES =  "?" . AppController::GET_PARAM_NAME_VIEWPAGE . "=services";
	protected const HREF_VALUE_ANCHOR_CONTACT =  "#contact";

	protected const CONTACT_SECTION_IN_PAGE = false;

	public function buildLogoOria(): string {
		$r = "";
		$r.="<a href=\".?#\">";
		$r.="<img class=\"logo-oria\" src=\"public/img/logo-oria.svg\" alt=\"ORIA\" />";
		$r.="</a>";
		return $r;
	}
	
	public function buildHeadContent(): string {
		$r = parent::buildHeadContent();
		$r.="<meta name=\"description\" content=\"" . $this->metaDescription . "\" />";
		$r.="<meta name=\"keywords\" content=\"" . $this->getMetaKeywords() . "\" />";
		$r.="<link rel=\"stylesheet\" href=\"public/css/vp-generic.css\" />";
		$r.="<script src=\"public/js/website_burger_menu.js\"></script>";
		return $r;
	}

	public function buildBodyContent(): string {
		$r = "";
		$r.=$this->buildHeader();
		$r.=$this->buildMain();
		$r.=$this->buildFooter();
		$r.=$this->buildDisablingLayer();
		return $r;
	}
	public function buildHeader(): string {
		$r = "";
		$r.="<header>";
    $r.=$this->buildHeaderContent();
    $r.="</header>";
		return $r;
	}
	public function buildHeaderContent(): string {
		$r = "";
    $r.=$this->buildLogoOria();
    $r.="<nav class=\"websiteMenu\">";
    $r.="<ul class=\"row-menu\">";
		$menuItems = DataManager::loadData(
			DataManager::PATH_TO_JSON_FOLDER . 'menuItems.json'
		);
		foreach ($menuItems as $menuItem) {
			// Prepare data & keys
			$itemLabelKey = 'label-' . $this->getLanguage();
			$itemHrefKey = 'href';
			$itemLabelValue = '[]';
			$itemHrefValue = '#';
			if (isset($menuItem->$itemLabelKey)) {
				$itemLabelValue = $menuItem->$itemLabelKey; }
			if (isset($menuItem->$itemHrefKey)) {
				$itemHrefValue = $menuItem->$itemHrefKey; }

			// Special rules
			if (isset($menuItem->id) && ($menuItem->id==4)) {
				$itemHrefValue = $this::HREF_VALUE_VIEWPAGE_SERVICES;
			}

			//
			// Item View
			$r.="<li class=\"decoratedItem-1\">";
			$r.="<a class=\"decorationContainer\" href=\"$itemHrefValue\">";
			$r.="<span>";
			$r.=$itemLabelValue;
			$r.="</span>";
			$r.="<div class=\"itemDecoration\">";
			$r.="</div>";
			$r.="</a>";
			$r.="</li>";
		}
    $r.="</ul>";
    $r.="</nav>";

    $r.="<div>";			
			$strGETParams = '';
			foreach ($_GET as $key=>$value) {
				if ($key!='lang') {
					$strGETParams.=$key . "=" .$value . "&";
				}
			}
			$strGETParams.="lang=" . $this->getOtherLanguage();
			$r.="<a id=\"lang-selector\" href=\"?" . $strGETParams . "\">" . strtoupper($this->getLanguage()) . "</a>";
			//$r.="<a class=\"hoverable-btn-1\" href=\"contact.html\">";
			$r.="<a class=\"hoverable-btn-1\" href=\"";
			if (!($this::CONTACT_SECTION_IN_PAGE)) {
				$r.=$this::HREF_VALUE_VIEWPAGE_HOME;
			}
			$r.="#contact\">";
				$r.="<div class=\"btn-contact\">";
					$r.="Contact";
				$r.="</div>";
			$r.="</a>";
			$r.="<div id=\"websiteMenu-btn\">";
				$r.="<svg viewBox=\"0 0 100 100\">";
					$r.="<path d=\"M0, 10 Q50, 10 100, 10\"></path>";
					$r.="<path d=\"M0, 50 Q50, 50 100, 50\"></path>";
					$r.="<path d=\"M0, 90 Q50, 90 100, 90\"></path>";
				$r.="</svg>";
			$r.="</div>";
		$r.="</div>";

		return $r;
	}
	public function buildMain(): string {
		$r = "";
		$r.="<main>";
		$r.=$this->buildMainContent();
		$r.="</main>";
		return $r;
	}
	public function buildMainContent(): string {
		$r = "";
		return $r;
	}
	public function buildFooter(): string {
		$r = "";
		$r.="<footer>";
		$r.="<div class=\"top-row\">";
		$r.=$this->buildLogoOria();
		$r.="<div>";
		$r.="<div class=\"columns\">";
		$r.="<div class=\"column\">";
		$r.="<h4>";
		
		$r.=$this->chooseStrLang([
			'fr' => "Suivez-nous",
			'en' => "Follow us"
		]);

		$r.="</h4>";
		$r.="<div class=\"social-icons\">";
		$r.="<a href=\"#\">";
		$r.="<img src=\"public/img/icon-facebook.svg\" alt=\"Facebook\" />";
		$r.="</a>";
		$r.="<a href=\"#\">";
		$r.="<img src=\"public/img/icon-instagram.svg\" alt=\"Instagram\" />";
		$r.="</a>";
		$r.="<a href=\"#\">";
		$r.="<img src=\"public/img/icon-tiktok.svg\" alt=\"Tiktok\" />";
		$r.="</a>";
		$r.="<a href=\"#\">";
		$r.="<img src=\"public/img/icon-linkedin.svg\" alt=\"LinkedIn\" />";
		$r.="</a>";
		$r.="</div>";
		$r.="</div>";
		$r.="<div class=\"column\">";
		$r.="<h4>";

		$r.=$this->chooseStrLang([
			'fr' => "Nos services",
			'en' => "Our services"
		]);

		$r.="</h4>";

		$servicesTypesTitles = DataManager::loadData(
			DataManager::PATH_TO_JSON_FOLDER . 'servicesTypes.json'
		);
		foreach ($servicesTypesTitles as $serviceTitle) {
			$label = '[]';
			$labelKey = 'label-' . $this->getLanguage();
			if (isset($serviceTitle->$labelKey)) {
				$label = $serviceTitle->$labelKey;
			}
			$r.="<a class=\"item\" href=\"" . $this::HREF_VALUE_VIEWPAGE_SERVICES . "\">" . $label . "</a>";
		}

		$r.="</div>";
		$r.="<div class=\"column\">";
		$r.="<h4>";
		
		$r.=$this->chooseStrLang([
			'fr' => "Nous contacter",
			'en' => "Contact us"
		]);

		$r.="</h4>";
		$r.="<a class=\"item icon-before email\" href=\"mailto:agency.oria@gmail.com\">agency.oria@gmail.com</a>";
		$r.="<a class=\"item icon-before phone\" href=\"#\">04 06 08 77 42</a>";
		$r.="<a class=\"item icon-before location\" href=\"#\">1 Rue de Chablis, 93000 Bobigny</a>";
		$r.="</div>";
		$r.="</div>";
		$r.="</div>";
		$r.="</div>";
		$r.="<hr />";

		$r.="<div class=\"bottom-row\">";
		$r.="<ul class=\"row-menu no-padding\">";

		$servicesTypesTitles = DataManager::loadData(
			DataManager::PATH_TO_JSON_FOLDER . 'footerBottomItems.json'
		);
		foreach ($servicesTypesTitles as $serviceTitle) {
			$label = '[]';
			$href = '#';
			$labelKey = 'label-' . $this->getLanguage();
			if (isset($serviceTitle->$labelKey)) {
				$label = $serviceTitle->$labelKey;
			}
			if (isset($serviceTitle->href)) {
				$href = $serviceTitle->href;
			}

			// Special rules
			if (isset($serviceTitle->id) && ($serviceTitle->id<=2)) {
				$href = "?" . AppController::GET_PARAM_NAME_VIEWPAGE . "=legal" . $href;
			}
			
			$r.="<li>";
				$r.="<a class=\"decoratedItem-1 decorationContainer white\" href=\"$href\">";
					$r.="<span>";
						$r.="$label";
					$r.="</span>";
					$r.="<div class=\"itemDecoration\">";
					$r.="</div>";
				$r.="</a>";
			$r.="</li>";
		}
		/*$r.="<li><a class=\"decoratedItem-1 decorationContainer white\" href=\"#\">";
		$r.="<span>Aide</span>";
		$r.="<div class=\"itemDecoration\"></div></a></li>";
		$r.="<li><a class=\"decoratedItem-1 decorationContainer white\" href=\"#\">";
		$r.="<span>FAQ</span>";
		$r.="<div class=\"itemDecoration\"></div></a></li>";*/

		$r.="</ul>";
		$r.="</div>";
		$r.="</footer>";
		return $r;
	}

	public function buildDisablingLayer(): string {
		$r = "";
		$r.="<div class=\"disablingLayer\">";
    $r.="</div>";
		return $r;
	}
	







	// #######################################################
	// Availble sections but not used here



	public function buildContactSection(): string {
		$r = "";
		$r.="<section id=\"contact\">";
			$r.="<h2>";
				$r.=$this->chooseStrLang([
					'fr' => "Contactez-nous",
					'en' => "Contact us"
				]);
			$r.="</h2>";
			$r.="<div class=\"wrapper\">";
				$r.="<div class=\"form-container left\">";
					$r.="<form id=\"contact-form\" action=\"?" . AppController::GET_PARAM_NAME_ACTION_REQUEST . "=" . AppController::ACTION_SEND_MAIL .
						"&" . AppController::GET_PARAM_NAME_RESPONSE_REQUEST . "=" . AppController::ACTION_CHECK_MAIL_SENT .
						"&hl=0\" method=\"POST\">";
						$r.="<div class=\"form-group double\">";
							$placeholder=$this->chooseStrLang([
								'fr' => "Votre prénom",
								'en' => "Firstname"
							]);
							$r.="<div class=\"form-group required\">";
								$r.="<input type=\"text\" name=\"prenom\" placeholder=\"$placeholder\" required />";
							$r.="</div>";
							$placeholder=$this->chooseStrLang([
								'fr' => "Votre nom",
								'en' => "Lastname"
							]);
							$r.="<div class=\"form-group required\">";
								$r.="<input type=\"text\" name=\"nom\" placeholder=\"$placeholder\" required />";
							$r.="</div>";
						$r.="</div>";
						$placeholder=$this->chooseStrLang([
							'fr' => "Votre email professionnel",
							'en' => "Your professional email"
						]);
						$r.="<div class=\"form-group required\">";
							$r.="<input type=\"email\" name=\"email\" placeholder=\"$placeholder\" required />";
						$r.="</div>";
						$placeholder=$this->chooseStrLang([
							'fr' => "Sujet du message",
							'en' => "Subject of the message"
						]);
						$r.="<div class=\"form-group\">";
							$r.="<input type=\"text\" name=\"subject\" placeholder=\"$placeholder\" />";
						$r.="</div>";
						$placeholder=$this->chooseStrLang([
							'fr' => "Votre message",
							'en' => "Your message"
						]);
						$r.="<div class=\"form-group required\">";
							$r.="<textarea name=\"message\" rows=\"4\" placeholder=\"$placeholder\" required></textarea>";
						$r.="</div>";
						$btnValue=$this->chooseStrLang([
							'fr' => "Envoyer",
							'en' => "Send"
						]);
						$r.="<div class=\"button-container\">";
							$r.="<button type=\"submit\" class=\"btn-submit\">$btnValue</button>";
						$r.="</div>";
					$r.="</form>";
				$r.="</div>";
				$r.="<div class=\"info-container right\">";
					$r.="<h3>";
						$r.=$this->chooseStrLang([
							'fr' => "Quelques chiffres",
							'en' => "Key figures"
						]);
					$r.="</h3>";
					$r.="<div class=\"stats\">";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Collaborateurs",
								'en' => "Employees"
							]);
							$r.="<img src=\"public/img/icon-3d-companies.png\" alt=\"$alt\" />";
							$r.="<span class=\"info\">";
								$r.="<b>+17</b>";
								$r.="<span>";
									$r.=$this->chooseStrLang([
										'fr' => "Entreprises",
										'en' => "Companies"
									]);	
								$r.="</span>";
							$r.="</span>";
						$r.="</div>";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Finances",
								'en' => "Finances"
							]);
							$r.="<img src=\"public/img/icon-3d-budget.png\" alt=\"$alt\" />";
							$r.="<span class=\"info\">";
								$r.="<b>0.5M€</b>";
								$r.="<span>";
									$r.=$this->chooseStrLang([
										'fr' => "Budget géré",
										'en' => "Managed budget"
									]);	
								$r.="</span>";
							$r.="</span>";
						$r.="</div>";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Produits",
								'en' => "Revenue"
							]);
							$r.="<img src=\"public/img/icon-3d-ads.png\" alt=\"$alt\" />";
							$r.="<span class=\"info\">";
								$r.="<b>+2k</b>";
								$r.="<span>";
									$r.=$this->chooseStrLang([
										'fr' => "Publicités produites",
										'en' => "Advertisements produced"
									]);	
								$r.="</span>";
							$r.="</span>";
						$r.="</div>";
					$r.="</div>";
					$r.="<h3>";
						$r.=$this->chooseStrLang([
							'fr' => "Nos coordonnées",
							'en' => "Contact details"
						]);
					$r.="</h3>";
					$r.="<div class=\"contact-details\">";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Adresse :",
								'en' => "Address:"
							]);
							$r.="<img src=\"public/img/icon-location.svg\" alt=\"$alt\" />";
							$r.="<span>1 Rue de Chablis, 93000 Bobigny</span>";
						$r.="</div>";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Téléphone :",
								'en' => "Phone number:"
							]);
							$r.="<img src=\"public/img/icon-phone.svg\" alt=\"$alt\" />";
							$r.="<span>";
								$r.=$this->chooseStrLang([
									'fr' => "04 06 09 77 42",
									'en' => "+33 4 06 09 77 42"
								]);
							$r.="</span>";
						$r.="</div>";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Email :",
								'en' => "Email:"
							]);
							$r.="<img src=\"public/img/icon-mail.svg\" alt=\"$alt\" /> ";
							$r.="<span>agency.oria@gmail.com</span>";
						$r.="</div>";
						$r.="<div class=\"item\">";
							$alt=$this->chooseStrLang([
								'fr' => "Horaires :",
								'en' => "Opening hours:"
							]);
							$r.="<img src=\"public/img/icon-clock.svg\" alt=\"$alt\" />";
							$r.="<span>";
								$r.=$this->chooseStrLang([
									'fr' => "9:00 à 13:00 et 14:00 à 19:00 du Lundi au Vendredi",
									'en' => "9:00 to 13:00 and 14:00 to 19:00 Monday to Friday"
								]);
							$r.="</span>";
						$r.="</div>";
					$r.="</div>";
			$r.="</div>";
		$r.="</section>";
		return $r;
	}


	
}

?>
