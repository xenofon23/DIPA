<?php
use App\Config\Config;
use App\Gateway\Gateway;
use App\Router\Router;
require_once "../vendor/autoload.php";


$config=new Config();
//$geteway=new Gateway();
//$geteway->load();
$request=new \App\Request\RequestReceived();
$routes =new \App\Router\Routes();
$routes->loadRoutesFromYaml('./Router/routes.yaml');
$router = new Router($request,$routes);
$routeMatched = $router->matchCurrentRequest();

if (!$routeMatched) {
   echo 'dento vrika';
}

