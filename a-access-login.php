<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/Authentication.php';
include_once __DIR__ . '/model/User.php';
$controller = new MyService();

$result = $controller->login($_POST['username'], $_POST['password']);

if ($result) {
    if(!$result->emailVerified){
        $controller->send_email_verification($_POST['username']);
        echo 'invalid-email-verified';
    }else{
        if(isset($result->customAttributes['admin']))
            $admin = true;
        else
            $admin = false;
        $userSignedIn = new User($result->uid,$result->displayName,$result->email,$result->photoUrl,$admin,$result->metadata->lastLoginAt,$result->disabled);
        $_SESSION['_userSignedIn'] = $userSignedIn;
        echo "true";
    }
} else {
    echo "false";
}