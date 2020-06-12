<?php
include_once __DIR__ . '/controller/FoodCtl.php';
$foodCtl = new FoodCtl();
if($arr_food = $foodCtl->delete($_POST['id']))
    echo 'true';
else
    echo 'false';
