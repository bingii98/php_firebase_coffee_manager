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
$description = $_POST['description'];
$isActive = true;
$isSale = $_POST['isSale'];
$list = $_POST['list'];
$name = $_POST['name'];
$price = $_POST['price'];
$sale = $_POST['rangeSale'];
$image = $fileCtl->upload($_FILES["file"]);

$response = $client->request('POST', 'v4/bitlinks', [
    'json' => [
        'long_url' => $image,
    ],
    'headers' => [
        'Authorization' => 'Bearer 6fd6283697a612068802681ef787760345768cc5'
    ],
    'verify' => false,
]);

if(in_array($response->getStatusCode(), [200, 201])) {
    $body = $response->getBody();
    $arr_body = json_decode($body);
    $image = $arr_body->link;
}
$food = new Food(null,$name,$description,$price,$image,$sale,$isSale);
if($foodCtl->insert($food,$_POST['list']))
    echo 'true';
else
    echo 'false';
