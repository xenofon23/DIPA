<?php
require_once "../vendor/autoload.php";
use App\Controllers\AuthenticationController;
use App\Services\User\UserDetails;

$data=['userName'=>'johndoe','password'=>'mysecretpassword'];
$controller=new AuthenticationController($data);
echo  $controller->enableLogin();
//$userDetails = UserDetails::getInstance(1);
//$test=$userDetails->getUserId();
//$data=['userName'=>'johndoe','password'=>'mysecretpassword'];
//$controller=new AuthenticationController($data);
// echo $controller->test();
