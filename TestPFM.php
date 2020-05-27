<?php
if (!isset($_SESSION)) session_start();
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$orderCtl = new OrderCtl();
$time_start = microtime(true);
$arr_table = $tableCtl->getAll_food();
echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);