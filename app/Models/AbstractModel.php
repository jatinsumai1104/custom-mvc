<?php

namespace App\Models;

use PDO;
use App\Exceptions\NotFoundException;

abstract class AbstractModel {
  protected $db;
  public function __construct(PDO $db){
    $this->db = $db;
  }

}