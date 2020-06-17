<?php
set_time_limit(120000); //
include_once './controller/FoodCtl.php';
include_once './controller/ListCtl.php';
include_once './controller/OrderCtl.php';
include_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
$foodCtl = new FoodCtl();
$listCtl = new ListCtl();
$orderCtl = new OrderCtl();

$arr = $foodCtl->getAll();

for ($i1 = 0; $i1 < 10000; $i1++) {
    for ($i = 0; $i < 5; $i++) {
        if ($i == 4) {
            if(!isset($_SESSION['order_generation_date']))
                $_SESSION['order_generation_date'] = 1577839582;
            else
                $_SESSION['order_generation_date'] += 2000;
            $orderCtl->order_generation($_SESSION['_userSignedIn']->getId(),$_SESSION['order_generation_date']);
            unset($_SESSION["cart_item"]);
        } else {
            $productByCode = $arr[rand(0, (count($arr) - 1))];
            if ($productByCode->getIsSale() == 'true') {
                $price = $productByCode->getPrice() - $productByCode->getPrice() / 100 * $productByCode->getSale();
            } else {
                $price = $productByCode->getPrice();
            }
            $itemArray = array($productByCode->getId() => array('name' => $productByCode->getName(), 'quantity' => rand(19,20), 'price' => $price));

            if (!empty($_SESSION["cart_item"])) {
                if (array_key_exists($productByCode->getId(), $_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($productByCode->getId() == $k) {
                            $_SESSION["cart_item"][$k]["quantity"] += 1;
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    }
}