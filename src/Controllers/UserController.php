<?php

namespace custom_mvc\Controllers;

use custom_mvc\Exceptions\NotFoundException;
use custom_mvc\Models\UserModel;

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