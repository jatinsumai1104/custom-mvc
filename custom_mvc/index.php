<?php
  use custom_mvc\Core\Router;
  use custom_mvc\Core\Request;
  use custom_mvc\Utils\DependencyInjector;
  use custom_mvc\Core\Config;
  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;

  require_once __DIR__ . '/vendor/autoload.php';


  $config = new Config();

  $dbConfig = $config->get('db');
  $db = new PDO(
    "mysql:host={$dbConfig['host']};dbname={$dbConfig['db_name']}",
    $dbConfig['user'],
    $dbConfig['password']
  );
  
  $loader = new Twig_Loader_Filesystem(__DIR__ . '/resources/views');
  $view = new Twig_Environment($loader);

  $log = new Logger('user');
  $logFile = $config->get('log');
  $log->pushHandler(
    new StreamHandler($logFile, Logger::DEBUG)
  );

  $di = new DependencyInjector();
  $di->set("Database", $db);
  $di->set("View", $view);
  $di->set("Log", $log);
  $di->set("Config", $config);


  $router = new Router($di);
  $response = $router->route(new Request());
  var_dump($response);
?>