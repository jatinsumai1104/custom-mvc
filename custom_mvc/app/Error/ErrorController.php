<?php

namespace App\Controllers;

class ErrorController extends AbstractController{
  public function notFound(){
    $properties = ['errorMessage' => 'Page Not Found!'];
    return $this->view('error', $properties);
  }
}