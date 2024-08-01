<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('../Global/config.php');
require_once('../models/users.php');
header('Content-Type: application/json');

$response = [];

try {
    $input = json_decode(file_get_contents('php://input'), true);
    error_log('Input: ' . print_r($input, true));

    $name = $input['name'] ?? null;
    // $username = $input['username'] ?? null;
    // $password = $input['password'] ?? null;
    $username = $input['username'] ?? 'yogesh@gmail.com';
    $password = $input['password'] ?? 'yogesh2016';
    $mode = $input['mode'] ?? 'SIGN_IN';

    $userObject = new Users();
    $userObject->username = $username;
    $userObject->name = $name;
    $userObject->password = $password;

    if ($mode === 'INSERT') {
        $insertResponse = $userObject->insertUsers($userObject);
        error_log('Insert response: ' . print_r($insertResponse, true));
        
        if ($insertResponse === 'SUCCESS') {
            $response = [
                'result' => true,
                'response' => 'success',
                'responseText' => '',
                'additionalResponse' => '',
                'additionalResponseText' => ''
            ];
        } else {
            $response = [
                'result' => false,
                'response' => 'failure',
                'responseText' => 'Insert failed'
            ];
        }
    } elseif ($mode === 'SIGN_IN') {
        $signInResponse = $userObject->getUserDetails($userObject);
    
        error_log('User details: ' . print_r($signInResponse, true));
        
        if ($signInResponse === 'SUCCESS') {
            $response = [
                'result' => true,
                'response' => 'success',
                'responseText' => '',
                'additionalResponse' => '',
                'additionalResponseText' => ''
            ];
        } else {
            $response = [
                'result' => false,
                'response' => 'failure',
                'responseText' => 'Invalid username or password'
            ];
        }
    }
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    $response = ['result' => false, 'response' => 'error', 'responseText' => $e->getMessage()];
}

echo json_encode($response);
?>
