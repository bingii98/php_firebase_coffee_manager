<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/controller/FoodCtl.php';
include __DIR__ . '/model/Table.php';

$foodCtl = new FoodCtl();

$factory = (new Factory)->withServiceAccount(__DIR__ . '/secret/key.json');
$firebase = $factory->createDatabase();

$firebase->getReference('order')->getChild();
