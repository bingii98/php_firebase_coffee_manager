<?php
include_once __DIR__ . '/controller/Authentication.php';
$controller = new MyService();

$result = $controller->set_admin("n6hJBcQWpIURKDihJk1Q429429C2","false");

if($result){
    echo "TC";
}else{
    echo "TB";
}