<?php
include_once __DIR__ . '/controller/Authentication.php';
include_once __DIR__ . '/model/User.php';
$account = new Authentication();

if (!isset($_SESSION)) session_start();

if(!isset($_SESSION['_userSignedIn']) && isset($_POST['email'])){
    $email = $_POST['email'];
}else{
    $email = $_SESSION['_userSignedIn']->getEmail();
}

$result = $account->forgot_password($email);
