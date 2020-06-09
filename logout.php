<?php
session_start();
unset($_SESSION["_userSignedIn"]);
header("Location: login.php");