<?php

namespace view\agency;

use model\agency\Benefit;
use view\View;

class BenefitView extends View {

  protected $benefit;

  public function __construct(Benefit $benefit) {
    $this->benefit = $benefit;
  }

  public function __toString(): string {
    $r = "";
    $id = 0;
    $catchphrase = '';
    $description = '';
    if (isset($this->benefit->id)) {
      $id = $this->benefit->id; }
    if (isset($this->benefit->catchphrase)) {
      $catchphrase = $this->benefit->catchphrase; }
    if (isset($this->benefit->shortDescription)) {
      $description = $this->benefit->shortDescription; }
    $r.="<div class=\"benefit row\">";
    $r.="<div class=\"column\">";
    $r.="<p class=\"num\">";
    $r.=str_pad($id, 2, '0', STR_PAD_LEFT);
    $r.="</p>";
    $r.="<h4 class=\"catchphrase\">";
    $r.=$catchphrase;
    $r.="</h4>";
    $r.="</div>";
      $r.="<div class=\"column\">";
        $r.="<p class=\"description\">";
          $r.=$description;
        $r.="</p>";
      $r.="</div>";
    $r.="</div>";
    return $r;
  }

}

?>