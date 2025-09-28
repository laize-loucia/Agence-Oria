<?php

namespace controller\agency;

use controller\Controller;
use model\agency\Benefit;

class BenefitController extends Controller {
  
  protected const PATH_TO_DATA = /*ROOT . '/*/'app/data/clientBenefits.json';
  
  public static function getClientBenefits() : array {
    $benefits = [];
    $benefitsData = self::loadData();
    foreach ($benefitsData as $benefitData) {
      $benefits[] = new Benefit($benefitData);
    }
    /*echo "<pre style='color: black; background-color: white; border: .2em ridge red; z-index: 1000;'>";
    var_dump($benefits);
    echo "</pre>";*/
    return $benefits;
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
    /*echo "<pre style='color: black; background-color: white; border: .2em ridge red; z-index: 1000;'>";
    var_dump($data);
    echo "</pre>";*/
    return $data;
  }

}

?>