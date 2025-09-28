<?php

namespace view\agency;

use controller\AppController;

class ProjectCardView extends ProjectView {

  public function __toString(): string {
    $r = "";
    $id = -1;
    $label = '';
    $shortDescription = '';
    $illustrationFileName = '';
    if (isset($this->project->id)) {
      $id = $this->project->id;
    }
    if (isset($this->project->label)) {
      $label = $this->project->label;
    }
    $shortDescKey = 'shortDescription_' . $this->getLanguage();
    if (isset($this->project->$shortDescKey)) {
      $shortDescription = $this->project->$shortDescKey;
    }
    if (isset($this->project->mainIllustrationFileName)) {
      $illustrationFileName = $this->project->mainIllustrationFileName;
    }
    //$r.="<a class=\"project column\" href=\"?" . AppController::GET_PARAM_NAME_VIEWPAGE . "=project&id=$id\" data-project=\"$label\">";
    $r.="<a class=\"project-card\" href=\"?" . AppController::GET_PARAM_NAME_VIEWPAGE . "=project&id=$id\">";
      $r.="<img src=\"public/img/$illustrationFileName\" alt=\"$label\">";
      $r.="<h3>";
        $r.="$label";
      $r.="</h3>";
      $r.="<p>";
        $r.="$shortDescription";
      $r.="</p>";
      $r.="<div class=\"btn-more\">";
        $r.=$this->chooseStrLang([
          'fr' => "Voir plus",
          'en' => "See more"
        ]);
      $r.="</div>";
    $r.="</a>";
    return $r;
  }

}

?>