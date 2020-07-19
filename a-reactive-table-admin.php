<?php
include 'check-admin.php';
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
if($arr_food = $tableCtl->reactive($_POST['id']))
    echo 'true';
else
    echo 'false';
