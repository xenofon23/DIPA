<?php
require_once "../vendor/autoload.php";

use App\Container\Container;
use App\Controllers\AuthenticationController;
use App\Services\matchProfileServices;
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
//$string = '\App\Controllers\AuthenticationController';
//$data = ['userId' => 123, 'name' => 'John Doe', 'email' => 'john.doe@example.com'];
//
//$container=new Container();
//$obj=$container->create('App\Controllers\UserDetailsController', $data);
//$obj->mal();
//$updateFields = [
//    'basic.location' => 'Athens',
//    'second.age' => '25'
//];
//
//$jsonFields = json_encode($updateFields);
//echo '';
$match=new matchProfileServices();
$test=$match->findBestMatch();
echo "";