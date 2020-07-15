<?php
include_once __DIR__ . '/controller/DrinkCtl.php';
$foodCtl = new DrinkCtl();
if($arr_food = $foodCtl->reactive($_POST['id']))
    echo 'true';
else
    echo 'false';
