<?php

namespace model\agency;

use stdClass;

class Benefit {

  protected static $_benefitNextId = 1;
  public $id;
  public $catchphrase = '';
  public $shortDescription = '';

  public function __construct(stdClass $data) {
    $this->id = $this::$_benefitNextId++;
    if (isset($data->catchphrase)) {
      $this->catchphrase = $data->catchphrase; }
    if (isset($data->shortDescription)) {
      $this->shortDescription = $data->shortDescription; }
  }
}

?>