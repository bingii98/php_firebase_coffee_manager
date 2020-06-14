<?php
$saDate = "01-".(isset($_GET['date']) ? isset($_GET['date']) : date("m-yy"));
$stDate = "t-".(isset($_GET['date']) ? isset($_GET['date']) : date("m-yy"));

$saDate = $d = DateTime::createFromFormat('d-m-Y H:i:s', '' . date($stDate) . ' 00:00:00', new DateTimeZone('UTC'));
$stDate = $d = DateTime::createFromFormat('d-m-Y H:i:s', '' . date($stDate) . ' 00:00:00', new DateTimeZone('UTC'));

echo date('d',$saDate->getTimestamp());