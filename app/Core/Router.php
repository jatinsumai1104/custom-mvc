<?php

namespace App\Core;
use App\Controllers\ErrorController;
class Router{
  private $route_map;
  private $di;
  private static $regexPatters = [
    'number' => '\d+',
    'string' => '\w+'
  ];

  public function __construct($di){
    $this->di = $di;
    $json = file_get_contents( __DIR__. '/../../config/routes.json');
    $this->routeMap = json_decode($json, true);
  }

  public function route(Request $request) {
    $path = $request->getPath();
    // return $request->toString();
    foreach( $this->routeMap as $route => $info){
      $regexRoute = $this->getRegexRoute($route, $info);
      if(preg_match("@^/$regexRoute$@", $path)){
        return $this->executeController(
          $route, $path, $info, $request
        );
      }
    }
    $errorController = new ErrorController($this->di, $request);
    return $errorController->notFound();
  }

  public function getRegexRoute(string $route, array $info): string{
    if(isset($info['params'])){
      foreach($info['params']  as $name => $type){
        $route = str_replace(':'.$name, self::$regexPatters[$type], $route);
      }
    }
    return $route;
  }

  public function extractParams(string $route, string $path): array {
    $params = [];
    $pathParts = explode('/', $path);
    $routeParts = explode('/', $route);

    foreach($routeParts as $key => $routePart){
      if(strpos($routePart, ':')=== 0){
        $name = substr($routePart, 1);
        $params[$name] = $pathParts[$key + 1];
      }
    }
    return $params;
  }

  public function executeController(
    string $route, 
    string $path, 
    array $info, 
    Request $request
  ) {
    $controllerName = 'App\Controllers\\'.$info['controller'].'Controller';
    $controller = new $controllerName($this->di, $request);

    if(isset($info['login']) && $info['login']){
      if($request->getCookies()->has('user')){
        $customerId = $request->getCookies()->get('user');
        $controller->setCustomerId($customerId);
      }else{
        $errorController = new CustomerController($this->di, $request);
        return $errorController->login();
      }
    }
    $params = $this->extractParams($route, $path);
    return call_user_func_array(
      [$controller, $info['method']], $params
    );
  }


  // public function get($route_name, $route){
  //   $fgc = file_get_contents(__DIR__.'../../config/routes.json');
  //   $data = json_decode($fgc);
  //   if(is_string($route)){
  //     $route = explode(":", $route);

  //   }

  // }
}