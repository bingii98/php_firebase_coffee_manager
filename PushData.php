<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require __DIR__ . '/vendor/autoload.php';

$factory = (new Factory)->withServiceAccount(__DIR__ . '/secret/key.json');
$firebase = $factory->createDatabase();

$data = $firebase->getReference('table')->getSnapshot()->hasChild('name');

echo print_r($data);
