<?php

namespace App\Controllers;

use App\Core\Request;


abstract class AbstractController {
  protected $request;
  protected $db;
  protected $config;
  protected $view;
  protected $log;
  protected $di;

  public function __construct($di, Request $request){
    $this->request = $request;
    $this->db = $di;
    $this->db = $di->get("Database");
    $this->config = $di->get("Config");
    $this->view = $di->get("View");
    $this->log = $di->get("Log");
  }

  public function setUserId(int $user_id){
    $this->user_id = $user_id;
  }

  protected function view(string $view, array $params = []): string {
    return $this->view->loadTemplate($view.'.twig')->render($params);
  }
}