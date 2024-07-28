<?php

session_start();

require_once('../Global/config.php');
require_once('../models/Login.php');
header('Content-Type: application/json');


$data = $_POST['data'];

$name = $data['name'];
$username = $data['$username'];
$password = $data['password'];

$userObject = new Users();

$userObject->username = $username;
$userObject->name = $name;
$userObject->password = $password;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $response = $userObject-> getUserDetails($Users);
   if($response == 'success'){

    APIResponseWithReturn(true,'success','','','');

   }else{
    APIResponseWithReturn(false,'fail','','','');

   }

}





