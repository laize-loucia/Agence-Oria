<?php

namespace view;

use model\Constants;

/**
 * A View object that builds the base of the website's HMI as text in HTML format.
 * Automatically builds every needed tag for a generic page.
 */
class ViewLegalPage extends ViewGenericPage {

	/*protected $project;

	public function __construct($project) {
		$this->project = $project;
	}*/
	
	public function getPageTitleEnd(): string {
		return Constants::TITLE_VALUE_SEPARATOR_GENERIC . Constants::TITLE_VALUE_END_SERVICES;
	}

	public function buildHeadContent(): string {
		$r = parent::buildHeadContent();
		$r.="<link rel=\"stylesheet\" href=\"public/css/services.css\" />";
		$r.="<script src=\"public/js/services_processus_timeline.js\"></script>";
		$r.="<script src=\"public/js/contact_submit_ajax.js\"></script>";
		return $r;
	}

	public function buildMainContent(): string {
		$r = "";
		$r.=$this->buildNoticiesSection();
		return $r;
	}
	public function buildNoticiesSection(): string {
		$r = "";
		$r.="<section id=\"noticies\">";
			$r.="<h2>";
				$r.="Mentions Légales";
			$r.="</h2>";

			$r.="<div style='margin-top: 3.33em; margin-bottom: 2em;'>";
				$r.="<h3 style='display: flex; flex-direction: column; gap: 2em;'>";
					$r.="Avant propos";
				$r.="</h3>";
				$r.="<div style='font-style: italic; opacity: .85;'>";
					$r.="<p>";
						$r.="Oria est une agence digitale fictive, immaginée par un groupe d'étudiants de l'IUT de Bobigny (BUT Métiers du Multimédia et de l'Internet).";
						$r.="<br />";
						$r.="Les membres de cette organisation, ayant participé à l'élaboration de cette vitrine et au projet d'application \"Ourcq'Spot\" sont toutefois de talentueuses personnes, constamment intéressées par des opportunités dans le digital, le graphisme, la communication et l'informatique !";
					$r.="</p>";
					$r.="<a href=\"?#contact\">";
						$r.="Nous contacter";
					$r.="</a>";
				$r.="</div>";
			$r.="</div>";
			
			$r.="<h3>";
				$r.="1. ";
				$r.="Présentation de l’agence";
			$r.="</h3>";
			$r.="<ul>";
				$r.="<li>";
					$r.="Nom de l’agence : Oria";
				$r.="</li>";
				$r.="<li>";
					$r.="Adresse : 1, rue de Chablis, 93000 Bobigny, France";
				$r.="</li>";
				$r.="<li>";
					$r.="Téléphone : 04 06 09 77 42";
				$r.="</li>";
				$r.="<li>";
					$r.="Email : agency.oria@gmail.com";
				$r.="</li>";
				$r.="<li>";
					$r.="Forme juridique : Fictive";
				$r.="</li>";
				$r.="<li>";
					$r.="Capital social : 0€";
				$r.="</li>";
				$r.="<li>";
					$r.="Numéro de SIRET : \"En cours d'immatriculation\" (disons)";
				$r.="</li>";
				$r.="<li>";
					$r.="Directrice de publication : Cyrielle Carvalheiro";
				$r.="</li>";
				$r.="<li>";
					$r.="Hébergeur du site : Alwaysdata (alwaysdata.com) - 91 Rue du Faubourg Saint-Honoré, 75008 Paris, France – Téléphone : 01 84 16 23 40";
				$r.="</li>";
			$r.="</ul>";

			$r.="<h3>";
				$r.="2. ";
				$r.="Propriété intellectuelle";
			$r.="</h3>";
			$r.="<p>";
				$r.="Le site et chacun des éléments qui le composent (notamment les textes, logos, images, éléments graphiques ou multimédias) sont la propriété exclusive de l’agence Oria, sauf mention contraire. Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite sans l’autorisation écrite préalable de l’agence Oria.";
			$r.="</p>";

			$r.="<h3>";
				$r.="3. ";
				$r.="Conditions d’utilisation";
			$r.="</h3>";
			$r.="<p>";
				$r.="En accédant au site, l’utilisateur accepte les présentes conditions d’utilisation. Oria s’efforce de fournir des informations aussi précises que possible, mais ne saurait être tenue pour responsable des omissions, des inexactitudes et des carences dans la mise à jour de ces informations.";
			$r.="</p>";

			$r.="<h3>";
				$r.="4. ";
				$r.="Limitation de responsabilité";
			$r.="</h3>";
			$r.="<p>";
				$r.="Oria ne pourra être tenue responsable des dommages directs et indirects causés au matériel de l’utilisateur lors de l’accès au site, et résultant soit de l’utilisation d’un matériel ne répondant pas aux spécifications techniques nécessaires, soit de l’apparition d’un bug ou d’une incompatibilité.";
			$r.="</p>";
			$r.="<p>";
				$r.="Oria décline toute responsabilité quant à l’utilisation qui pourrait être faite des informations et contenus présents sur son site.";
			$r.="</p>";

			$r.="<h3 id=\"privacyPolicy\">";
				$r.="5. ";
				$r.="Gestion des données personnelles";
			$r.="</h3>";
			$r.="<p>";
				$r.="Oria est susceptible de collecter certaines informations personnelles de l’utilisateur, notamment via des formulaires de contact. Conformément à la loi \"Informatique et Libertés\" et au Règlement Général sur la Protection des Données (RGPD), l’utilisateur dispose d’un droit d’accès, de rectification, de suppression et d’opposition des données le concernant.";
			$r.="</p>";
			$r.="<p>";
				$r.="Pour exercer ces droits, veuillez adresser un email à agency.oria@gmail.com.";
			$r.="</p>";

			$r.="<h3 id=\"cookies\">";
				$r.="6. ";
				$r.="Cookies";
			$r.="</h3>";
			$r.="<p>";
				$r.="Le site peut utiliser des cookies pour optimiser l’expérience utilisateur. L’utilisateur est informé qu’il peut configurer son navigateur pour refuser les cookies. La poursuite de la navigation sans modifier les paramètres du navigateur vaut acceptation de l’utilisation des cookies.";
			$r.="</p>";

			$r.="<h3>";
				$r.="7. ";
				$r.="Droit applicable et juridiction compétente";
			$r.="</h3>";
			$r.="<p>";
				$r.="Les présentes mentions légales sont régies par la loi française. En cas de litige, et à défaut de résolution amiable, les tribunaux français seront seuls compétents pour en connaître.";
			$r.="</p>";
		$r.="</section>";
		return $r;
	}

}

?>
