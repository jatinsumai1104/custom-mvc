<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\UserModel;

class UserController extends AbstractController {

  private $userModel;
  public function __construct($di, $request) {
    parent::__construct($di, $request);
    $this->userModel = new UserModel($this->db);
  }
  public function getAll() {
    return $this->userModel->getAll();
  }

  public function getById(int $id){
    return $this->userModel->getById($id);
  }
}