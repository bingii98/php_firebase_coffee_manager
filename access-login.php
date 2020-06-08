<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/Authentication.php';
include_once __DIR__ . '/model/User.php';
$controller = new MyService();

$result = $controller->login($_POST['username'], $_POST['password']);
if ($result) {
    $userSignedIn = new User($result->uid,$result->displayName,$result->email,$result->photoUrl,$result->disabled);
    $_SESSION['_userSignedIn'] = $userSignedIn;
    echo "true";
} else {
    echo "false";
}