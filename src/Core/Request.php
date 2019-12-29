<?php

namespace custom_mvc\Core;

class Request{
  const GET = 'GET';
  const POST = 'POST';

  private $domain;
  private $path;
  private $method;

  private $params;
  private $cookies;

  public function __construct(){
    $this->domain = $_SERVER['HTTP_HOST'];
    $this->path = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->params = new FilteredMap(
      array_merge($_POST, $_GET)
    );
    $this->cookies = new FilteredMap($_COOKIE);
  }

  public function getURL(): string {
    return $this->domain . $this->path;
  }

  public function getDomain(): string {
    return $this->domain;
  }

  public function getPath(): string {
    return $this->path;
  }

  public function getMethod(): string {
    return $this->method;
  }

  public function isPOst(): bool {
    return $this->method === self::POST;
  }

  public function isGET(): bool {
    return $this->method === self::GET;
  }

  public function getParams(): FilteredMap {
    return $this->params;
  }

  public function getCookies(): FilteredMap {
    return $this->cookies;
  }

  public function toString() {
    return [
      "domain" => $this->getDomain(),
      "path" => $this->getPath(),
      "Method" => $this->method,
      "Params" => $this->params
    ];
  }

}

?>