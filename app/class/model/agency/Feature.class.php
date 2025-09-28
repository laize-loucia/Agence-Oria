<?php

namespace model\agency;

use stdClass;

class Feature {

  protected static $_featureNextId = 1;
  public $id;
  public $catchphrase = '';
  public $shortDescription = '';
  public $iconFileName = '';
  public $iconAlt = '';

  public function __construct(stdClass $data) {
    $this->id = $this::$_featureNextId++;
    if (isset($data->catchphrase)) {
      $this->catchphrase = $data->catchphrase; }
    if (isset($data->shortDescription)) {
      $this->shortDescription = $data->shortDescription; }
    if (isset($data->iconFileName)) {
      $this->iconFileName = $data->iconFileName; }
    if (isset($data->iconAlt)) {
      $this->iconAlt = $data->iconAlt; }
  }
}

?>