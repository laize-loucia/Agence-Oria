<?php

namespace controller\agency;

use controller\Controller;
use model\agency\Feature;

class FeatureController extends Controller {
  
  protected const PATH_TO_DATA = /*ROOT . '/*/'app/data/features.json';
  
  public static function getFeatures() : array {
    $features = [];
    $featuresData = self::loadData();
    foreach ($featuresData as $featureData) {
      $features[] = new Feature($featureData);
    }
    return $features;
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