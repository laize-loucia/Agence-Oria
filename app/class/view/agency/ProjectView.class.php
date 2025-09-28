<?php

namespace view\agency;

use controller\AppController;
use model\agency\Project;
use view\View;

class ProjectView extends View {

  protected $project;

  public function __construct(Project $project) {
    $this->project = $project;
  }

}

?>