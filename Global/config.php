<?php

require_once ('defaultfunction.php');

$db_host = 'localhost';
$db_name =  'tailwebtask';
$db_user = 'root';
$db_password = '';


function pdoConnect(){

    global $db_host, $db_name, $db_user, $db_password;
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
}