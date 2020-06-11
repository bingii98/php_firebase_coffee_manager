<?php

use GuzzleHttp\Client;

require_once __DIR__ . '/controller/FileCtl.php';
require_once __DIR__ . '/controller/FoodCtl.php';
require_once __DIR__ . '/model/Food.php';
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
function removeAscent($str)
{
    if ($str == null || isset($str))
        return $str;
    $str = strtolower($str);
    $a = array('à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ');
    $e = array('è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ');
    $i = array('ì', 'í', 'ị', 'ỉ', 'ĩ');
    $o = array('ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ');
    $u = array('ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ');
    $y = array('ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ');
    $d = array('đ');
    $str = str_replace($a, "a", $str);
    $str = str_replace($e, "e", $str);
    $str = str_replace($i, "i", $str);
    $str = str_replace($o, "o", $str);
    $str = str_replace($u, "u", $str);
    $str = str_replace($y, "y", $str);
    $str = str_replace($d, "d", $str);
    return $str;
}

function isValidName($string)
{
    $re = "/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]){2,50}$/";
    return preg_match($re, $string);
}

function isNaturalNumber($n)
{
    $n = trim($n, " ");
    $n1 = Math . abs(n);
    $n2 = intval($n, 10);
    return !is_nan($n1) && $n2 == $n1 && $n1 == $n;
}

$a = true;
if (isNaturalNumber($price)) {
    if (Number($price) > 500000)
        $a = false;
} else {
    $a = false;
}

if (!isValidName($name))
    $a = false;


if ($_FILES["file"] == null)
            $a = false;

if($a){
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

//INSERT FOOD TO FIREBASE
    $food = new Food(null, $name, $description, $price, $image, $sale, $isSale);
    if ($foodCtl->insert($food, $_POST['list']))
        echo 'true';
    else
        echo 'false';
}else{
    echo 'false';
}
