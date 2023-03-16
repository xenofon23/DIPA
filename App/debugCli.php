<?php
require_once "../vendor/autoload.php";
use App\Controllers\AuthenticationController;

$data=['userName'=>'johndoe','password'=>'mysecretpassword'];
$controller=new AuthenticationController($data);
echo  $controller->enableLogin();