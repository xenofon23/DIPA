<?php

use App\Config\Config;
use App\Container\Container;
use App\Gateway\Gateway;
use App\Router\Router;
require_once "../vendor/autoload.php";

$config=new Config();
$request=new \App\Request\RequestReceived();
$routes =new \App\Router\Routes();
$routes->loadRoutesFromJson();
$container=new Container();
$router = new Router($request,$routes,$container);
$geteway=new Gateway($router,$request);
echo $geteway->load();



