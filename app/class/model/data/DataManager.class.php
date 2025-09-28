<?php

namespace model\data;

class DataManager {

  public const PATH_TO_JSON_FOLDER = 'app/data/';

  public static function loadData(string $pathToData) : array {
    $data = [];
    $pathToData = str_replace('\\', '/', $pathToData);
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