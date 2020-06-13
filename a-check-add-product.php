<?php

use GuzzleHttp\Client;

require_once __DIR__.'/controller/FileCtl.php';
require_once __DIR__.'/controller/FoodCtl.php';
require_once __DIR__.'/model/Food.php';
$client = new Client([
    'base_uri' => 'https://api-ssl.bitly.com/',
]);
$fileCtl = new FileCtl();
$foodCtl = new FoodCtl();

/* GET VALUE */
$description = $_POST['description'];
$isActive = true;
$isSale = $_POST['isSale'];
$list = $_POST['list'];
$name = $_POST['name'];
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


if ($_FILES["file"] == null) {
    $a = false;
}
/* IF FORM VALID */
if ($a) {
    /*  CHECK EXIST NAME */
    if ($foodCtl->get_by_name($name) == null) {
        /*  UPLOAD FILE TO FIREBASE STORAGE */
        $image = $fileCtl->upload($_FILES["file"]);

        /*  SORT LINK BIT.LY */
        $response = $client->request('POST', 'v4/bitlinks', [
            'json' => [
                'long_url' => $image,
            ],
            'headers' => [
                'Authorization' => 'Bearer 6fd6283697a612068802681ef787760345768cc5'
            ],
            'verify' => false,
        ]);
        if (in_array($response->getStatusCode(), [200, 201])) {
            $body = $response->getBody();
            $arr_body = json_decode($body);
            $image = $arr_body->link;
        }

        /*  INSERT FOOD TO FIREBASE */
        $food = new Food(null, $name, $description, $price, $image, $sale, $isSale, true);
        if ($foodCtl->insert($food, $_POST['list']))
            echo 'true';
        else
            echo 'false';
    } else {
        echo 'double';
    }
} else {
    echo 'false';
}
