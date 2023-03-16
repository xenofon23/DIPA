<?php
use App\Config\Config;
use App\Gateway\Gateway;
use App\Router\Router;
require_once "../vendor/autoload.php";

//$config=new Config();
$request=new \App\Request\RequestReceived();
$routes =new \App\Router\Routes();
$routes->loadRoutesFromJson();
$router = new Router($request,$routes);
$geteway=new Gateway($router,$request);
$output=$geteway->load();
echo $output;


