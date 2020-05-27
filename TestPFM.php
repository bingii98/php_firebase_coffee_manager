<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/FoodCtl.php';
$food_ctl = new FoodCtl();
$time_start = microtime(true);
$item = $food_ctl->get("-M6nnNMSU6lZP0ycE5L3");
echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);