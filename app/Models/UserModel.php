<?php

namespace App\Models;

use App\Exceptions\NotFoundException;

class UserModel extends AbstractModel{

  public function __construct($db){
    parent::__construct($db);
  }

  public function getById(int $user_id){
    $query = 'select * from user where user_id = :user_id';
    $sth = $this->db->prepare($query);
    $sth->execute(['user_id' => $user_id]);

    $row = $sth->fetch();

    if(empty($row)){
      throw new NotFoundException();
    }
    return $row;
  }

  public function getAll(){
    $query = 'select * from user';
    $sth = $this->db->prepare($query);
    $sth->execute();
    $row = $sth->fetchAll();
    if(empty($row)){
      throw new NotFoundException();
    }
    return $row;
  }
}