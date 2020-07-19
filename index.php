<?php
include_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php');

if($_SESSION['_userSignedIn']->getIsAdmin()){ ?>
    <script !src="">alert("Bạn là admin")</script>
<?php }else{ ?>
    <script !src="">alert("Bạn là nhân viên")</script>
<?php }

//header('Location: staff-manager.php');