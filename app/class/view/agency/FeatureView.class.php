<?php

namespace view\agency;

use model\agency\Feature;
use view\View;

class FeatureView extends View {

  protected $feature;

  public function __construct(Feature $feature) {
    $this->feature = $feature;
  }

  public function __toString(): string {
    $r = "";
    $catchphrase = '';
    $description = '';
    $iconFileName = '';
    $iconAlt = '';
    if (isset($this->feature->catchphrase)) {
      $catchphrase = $this->feature->catchphrase; }
    if (isset($this->feature->shortDescription)) {
      $description = $this->feature->shortDescription; }
    if (isset($this->feature->iconFileName)) {
      $iconFileName = $this->feature->iconFileName; }
    if (isset($this->feature->iconAlt)) {
      $iconAlt = $this->feature->iconAlt; }
    $r.="<div class=\"feature-wrapper column\">";
      $r.="<div class=\"feature row\">";
        $r.="<img class=\"feature-icon\" src=\"public/img/$iconFileName\" alt=\"$iconAlt\" />";
        $r.="<div class=\"content column\">";
          $r.="<h3 class=\"feature-catchphrase\">";
            $r.=$catchphrase;
          $r.="</h3>";
          $r.="<p class=\"feature-description\">";
            $r.=$description;
          $r.="</p>";
        $r.="</div>";
      $r.="</div>";
    $r.="</div>";
    return $r;
  }

}

?>