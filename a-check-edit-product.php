<?php

use GuzzleHttp\Client;

require_once __DIR__.'/controller/FileCtl.php';
require_once __DIR__ . '/controller/DrinkCtl.php';
require_once __DIR__ . '/model/Drink.php';
$client = new Client([
    'base_uri' => 'https://api-ssl.bitly.com/',
]);
$fileCtl = new FileCtl();
$foodCtl = new DrinkCtl();

/* GET VALUE */
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$isSale = $_POST['isSale'];
$price = $_POST['price'];
$sale = $_POST['rangeSale'];

/*  CHECK DATA FORM */
function isValidName($string)
{
    $re = "/^([a-zA-Z0-9\-ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+){2,200}$/";
    return preg_match($re, $string);
}

function isNaturalNumber($n)
{
    $n = trim($n, " ");
    $n1 = abs($n);
    $n2 = intval($n, 10);
    return !is_nan($n1) && $n2 == $n1 && $n1 == $n;
}

$a = true;
if (isNaturalNumber($price)) {
    if ($price > 500000) {
        $a = false;
    }
} else {
    $a = false;
}

if (!isValidName($name)) {
    $a = false;
}

/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($foodCtl->get_by_name($name) == null || $foodCtl->get_by_name($name)->getName() == $name) {
        /*  INSERT FOOD TO FIREBASE */
        $food = new Food($id, $name, $description, $price, null, $sale, $isSale, null);
        if ($foodCtl->update($food))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
