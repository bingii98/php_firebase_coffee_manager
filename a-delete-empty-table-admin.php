<?php
include_once __DIR__ . '/controller/TableCtl.php';
$tableCtl = new TableCtl();
$result = $tableCtl->disable($_POST['id']);
if($result == 'double')
    echo 'double';
else if($result == 'true')
    echo 'true';
else
    echo 'false';
