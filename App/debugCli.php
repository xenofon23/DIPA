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

$result = preg_replace('/^.*\\\\/', '', $string);
$result=preg_replace('/Controller/', '', $result);
echo $result;