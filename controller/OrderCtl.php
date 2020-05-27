<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include_once './model/Table.php';
include_once './model/Food.php';
include_once './model/Order.php';
include_once './model/OrderDetail.php';
include_once './controller/TableCtl.php';
include_once './controller/ListCtl.php';
include_once './controller/FoodCtl.php';


class OrderCtl{

    protected $firebase;
    protected $table_ctl;
    protected $food_ctl;

    /**
     * UserCtl constructor.
     * @param $firebase
     */
    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $firebase = $factory->createDatabase();
        $this->firebase = $firebase;
        $this->table_ctl = new TableCtl();
        $this->food_ctl = new FoodCtl();
    }

    public function insert($table_id){
        $arr_order_detail = array();
        foreach ($_SESSION["cart_item"] as $key => $item){
            array_push($arr_order_detail, new OrderDetail($this->food_ctl->get_from_list_id($key),$item['quantity'],$item['price']));
        }
        $order = new Order(null,date("h:i A d/m/Y"),23,$arr_order_detail);
        if(isset($_SESSION["cart_item"])){
            $result = $this->firebase->getReference('orders')->push($order->pushFB());
            $this->tableCtl = new TableCtl();
            $this->tableCtl->updateStatus($table_id,$result->getSnapshot()->getKey());
        }
    }

    public function get($id){
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list['detail'] as $value){
            array_push($arr, new OrderDetail($this->food_ctl->get_from_list_id($value['food']),$value['num'],$value['price']));
        }
        return new Order($id,$list['date'],$list['staff'],$arr);
    }

    public function countFood($id){
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        if($list != null)
            return $list['detail'];
        return 0;
    }
}