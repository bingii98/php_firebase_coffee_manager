<?php
include_once './controller/Authentication.php';
include_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();

$account = new MyService();
if ($_POST['action'] == 'check') {
    if ($account->check_email_exist($_POST['email'])) {
        echo 'true';
    } else {
        echo 'false';
    }
}

if ($_POST['action'] == 'change') {
    if(isset($_POST['email'])){
        if ($_POST['email'] == $_SESSION['_userSignedIn']->getEmail()) {
            echo 'double';
        }else if ($account->change_email_verification($_SESSION['_userSignedIn']->getId(), $_POST['email'])) {
            $_SESSION['_userSignedIn']->setEmail($_POST['email']);
            echo 'true';
        } else {
            echo 'false';
        }
    }else if(isset($_POST['name'])){
        if ($_POST['name'] == $_SESSION['_userSignedIn']->getName()) {
            echo 'double';
        }else if ($account->change_name_display($_SESSION['_userSignedIn']->getId(), $_POST['name'])) {
            $_SESSION['_userSignedIn']->setName($_POST['name']);
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
