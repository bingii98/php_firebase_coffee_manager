<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
if($arr_food = $tableCtl->delete($_POST['id']))
    echo 'true';
else
    echo 'false';
