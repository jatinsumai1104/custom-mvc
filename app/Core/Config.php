<?php

namespace App\Core;
use App\Exceptions\NotFoundException;

class Config{
  private $data;
  
  function __construct() {
    $json = file_get_contents( __DIR__ . '/../../config/app.json');
    $this->data = json_decode($json, true);
  }

  public function get($key) {
    // die(var_dump($this->data[$key]));
    if(!isset($this->data[$key])){
      die("Key $key not in config");
    }
    return $this->data[$key];
  }
}