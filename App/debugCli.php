<?php
require_once "../vendor/autoload.php";
use App\Controllers\AuthenticationController;
use App\Services\User\UserDetails;
use App\View\Page;

//$data=['userName'=>'johndoe','password'=>'mysecretpassword'];
//$controller=new AuthenticationController($data);
//echo  $controller->enableLogin();
//$userDetails = UserProfile::getInstance(1);
//$test=$userDetails->getUserId();
//$data=['userName'=>'johndoe','password'=>'mysecretpassword'];
//$controller=new AuthenticationController($data);
// echo $controller->test();
//$page=new Page();
//$test=$page->generatePage('/index.html');
//echo 'malakia';
$string = '\App\Controllers\AuthenticationController';
$container=new Container();
// Add a service to the container
$container->addService('logger', new Logger());

// Create an instance of a class with a dependency on the 'logger' service
$myClass = $container->create(MyClass::class);

// Use the instance of MyClass
$myClass->doSomething();
