<?php
include_once __DIR__ . '/controller/Authentication.php';
$controller = new MyService();

$result = $controller->login("bingii901@gmail.com","123456");

if($result){
    echo "TC";
}else{
    echo "TB";
}