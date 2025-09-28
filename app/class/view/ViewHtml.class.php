<?php

namespace view;

use model\Constants;

/**
 * A View object that builds a HMI as text in HTML format.
 * Automatically builds every needed tag for a validated HTML document.
 */
class ViewHtml extends View{

	protected const PRETTY_PRINT = false; // WARNING: true => <textarea> initial content is filled with spaces!!!
	protected $metaDescription = "Oria est l'agence qu'il vous faut pour vos projets du digital !";
	protected $arrayMetaKeywords = [
		'Oria', 'Agence', 'Digital', 'Communication', 'Online', 'Équipe'
	];
	
	/**
	 * Returns the content used in the <title> tag.
	 * 	(Split between ->getPageTitleStart() and ->getPageTitleEnd())
	 * 
	 * @return string
	 */
	public function getPageTitle(): string {
		return $this->getPageTitleStart() . $this->getPageTitleEnd();
	}
	/**
	 * Returns the first part of the <title> tag's content, which should be the website's title.
	 * 
	 * @return string
	 */
	public function getPageTitleStart(): string {
		return Constants::TITLE_VALUE_START_GENERIC;
	}
	/**
	 * Returns the last part of the <title> tag's content, which should be the website's current page's name.
	 * 	(Here returns "" by default)
	 * 
	 * @return string
	 */
	public function getPageTitleEnd(): string {
		return "";
	}



	public function buildHtml(): string {
		$r = "";
		$r.="<html lang=\"" . $this->getLanguage() . "\">";
		$r.=$this->buildHead();
		$r.=$this->buildBody();
		$r.="</html>\n";
		if (self::PRETTY_PRINT) {
			$r = self::prettyPrintHtml($r);
		}
		return $r;
	}

	public function buildHead(): string {
		$r = "";
		$r.="<head>";
		$r.=$this->buildHeadContent();
		$r.="</head>";
		return $r;
	}
	public function buildHeadContent(): string {
		$r = "";
		$r.="<meta charset=\"utf-8\" />";
		$r.="<meta name=\"viewport\" content=\"initial-scale=1.0,width=device-width\" />";
		$r.="<link rel=\"icon\" type=\"image/x-icon\" href=\"public/img/favicon.ico\" />";
		$r.="<title>" . $this->getPageTitle() . "</title>";
		return $r;
	}
	public function getMetaKeywords(): string {
		$r = "";
		for ($i=0; $i<count($this->arrayMetaKeywords); $i++) {
			$r.=$this->arrayMetaKeywords[$i];
			if ($i!=(count($this->arrayMetaKeywords)-1)) {
				$r.=", ";
			}
		}
		$r = trim($r);
		return $r;
	}

	public function buildBody(): string {
		$r = "";
		$r.="<body>";
		$r.=$this->buildBodyContent();
		$r.="</body>";
		return $r;
	}
	public function buildBodyContent(): string {
		$r = "";
		$r.="	<p>[default content]</p>";
		return $r;
	}







	
	public static function prettyPrintHtml($content, $tab="\t"){
    // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
		$content = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $content);

		// now indent the tags
		$token = strtok($content, "\n");
		$r = ''; // holds formatted version as it is built
		$pad = 0; // initial indent
		$matches = array(); // returns from preg_matches()

		// scan each line and adjust indent based on opening/closing tags
		while ($token !== false) {
			$token = trim($token);
			if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) {
				// 1. open and closing tags on same line - no change
				$indent=0;
			} elseif (preg_match('/^<\/\w/', $token, $matches)) {
				// 2. closing tag - outdent now
				$pad--;
				if((isset($indent)) && ($indent>0)) {
					$indent=0;
				}
			} elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) {
				// 3. opening tag - don't pad this one, only subsequent tags
				$indent=1;
			} else {
				// 4. no indentation needed
				$indent = 0;
			}
			// pad the line with the required number of leading spaces
			$line = str_pad($token, strlen($token)+$pad, $tab, STR_PAD_LEFT);
			$r .= $line."\n"; // add to the cumulative result, with linefeed
			$token = strtok("\n"); // get the next token
			$pad += $indent; // update the pad size for subsequent lines    
		}       
		return $r;
	}

	
		




	
	/**
	 * Accesses the HMI/display as a string in HTML format.
	 * 	( HTML is always valid )
	 * 	( includes a <!DOCTYPE html> tag )
	 * 
	 * @return string
	 */
	public function __toString(): string {
		$r="";
		$r.=Constants::XML_TAG_DOCTYPE_HTML_STR_FULL;
		if (self::PRETTY_PRINT) {
			$r.="\n";
		}
		$r.=$this->buildHtml();
		return $r;
	}
	

}

?>
