<?php

require_once __DIR__ . '/controller/FoodCtl.php';

$ctl = new FoodCtl();

echo print_r($ctl->get_by_name("BinGii Giang"));