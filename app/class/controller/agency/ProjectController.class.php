<?php

namespace controller\agency;

use controller\Controller;
use model\agency\Project;

class ProjectController extends Controller {
  
  protected const PATH_TO_DATA = /*ROOT . '/*/'app/data/projects.json';
  
  public static function getProjectWithId(int $id) : ?Project {
    $project = null;
    $projectsData = self::loadData();
    foreach ($projectsData as $projectData) {
      if ((isset($projectData->id)) && ($projectData->id==$id)) {
        $project = new Project($projectData);
        return $project;
      }
    }
    return $project;
  }
  
  public static function getProjects(int $limit=null) : array {
    $projects = [];
    $projectsData = self::loadData();
    foreach ($projectsData as $key=>$projectData) {
      $projects[] = new Project($projectData);
      if ((isset($limit)) && ($key >= $limit-1)) {
        break;
      }
    }
    return $projects;
  }

  public static function loadData() : array {
    $data = [];
    $pathToData = str_replace('\\', '/', self::PATH_TO_DATA);
    if (file_exists($pathToData)) {
      $strData = file_get_contents($pathToData);
      $decodedData = json_decode($strData);
      
      if (is_array($decodedData)) {
        $data = $decodedData;
      }
    }
    return $data;
  }

}

?>