<?php
include_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
$result = $arr_food = $listCtl->disable($_POST['id']);
if($result == 'double')
    echo 'double';
else if($result == 'true')
    echo 'true';
else
    echo 'false';
