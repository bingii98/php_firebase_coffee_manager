<?php
include_once __DIR__ . '/controller/Authentication.php';
include_once __DIR__ . '/model/User.php';
$account = new MyService();

if (!isset($_SESSION)) session_start();

$result = $account->forgot_password($_SESSION['_userSignedIn']->getEmail());
