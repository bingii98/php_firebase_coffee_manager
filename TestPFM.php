<?php
include_once __DIR__ . '/controller/FoodCtl.php';
$foodCtl = new FoodCtl();
$arr_table = $foodCtl->get("-M6nnNMSU6lZP0ycE5L3");

echo print_r($arr_table);