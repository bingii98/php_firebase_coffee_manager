<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
date_default_timezone_set('UTC');
$factory = (new Factory)->withServiceAccount('./secret/key.json');
$firebase = $factory->createDatabase();
$list = $firebase->getReference('orders')->orderByChild('date')->getSnapshot()->getValue();

$index = 0;
foreach ($list as $key => $item){
    $index++;
    echo $index.' - '.date('h:mA d-m-Y', $item['date']);;
    echo "<br>";
}