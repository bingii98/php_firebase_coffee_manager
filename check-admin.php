<?php
require_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php');
if (!$_SESSION['_userSignedIn']->getIsAdmin()) {
    header('Location: 403.html');
}