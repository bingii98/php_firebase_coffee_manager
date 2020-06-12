<?php
include_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
if($arr_food = $listCtl->delete($_POST['id']))
    echo 'true';
else
    echo 'false';
