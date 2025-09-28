<?php

namespace model\data;

use stdClass;

#[\AllowDynamicProperties]
class DynamicDataModel {

  public function __construct(stdClass $data) {
    foreach (get_object_vars($data) as $key=>$value) {
      $this->$key = $value;
    }
  }

  public function __get(string $name): mixed {
    if (isset($this->$name)) {
      return $this->$name;
    }
    return null;
  }
  
}

?>