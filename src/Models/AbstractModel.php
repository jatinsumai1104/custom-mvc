<?php

namespace custom_mvc\Models;

use PDO;
use custom_mvc\Exceptions\NotFoundException;

abstract class AbstractModel {
  protected $db;
  public function __construct(PDO $db){
    $this->db = $db;
  }

}