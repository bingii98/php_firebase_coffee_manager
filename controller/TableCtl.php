<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include_once './model/Table.php';
include_once './model/Food.php';
include_once './model/Order.php';
include_once './model/OrderDetail.php';
include_once './controller/OrderCtl.php';
date_default_timezone_set('asia/ho_chi_minh');
class TableCtl
{

    protected $firebase;

    /**
     * UserCtl constructor.
     * @param $firebase
     */
    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $firebase = $factory->createDatabase();
        $this->firebase = $firebase;
    }

    public function getAll(){
        $arr = array();
        $list = $this->firebase->getReference('table')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            array_push($arr,new Table($key,$item['name'],null));
        }

        return $arr;
    }

    public function getAll_food(){
        $arr = array();
        $orderCtl = new OrderCtl();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_orders = array();
            if(isset($item['orders'])){
                foreach ($item['orders'] as $value){
                    array_push($arr_orders,$orderCtl->get($value));
                }
            }
            array_push($arr,new Table($key,$item['name'],$arr_orders));
        }
        return $arr;
    }

    public function get_empty_food(){
        $arr = array();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_orders = array();
            if(isset($item['orders'])){
                foreach ($item['orders'] as $keyOrder => $itemOrder){
                    $arr_orders_detail = array();
                    foreach ($itemOrder as $keyOrderDetail => $itemOrderDetail){
                        array_push($arr_orders_detail, new OrderDetail(new Food($itemOrderDetail['code'],$itemOrderDetail['name'],null,null,null,null,null),$itemOrderDetail['quantity'],$itemOrderDetail['price']));
                    }
                    array_push($arr_orders,new Order($keyOrder,date("h:i A d/m/yy"),null,$arr_orders_detail));
                }
            }
            if($arr_orders == null || count($arr_orders) == 0) {
                array_push($arr, new Table($key, $item['name'], $arr_orders));
            }
        }
        return $arr;
    }

    public function get_not_empty_food(){
        $arr = array();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_orders = array();
            if(isset($item['orders'])){
                foreach ($item['orders'] as $keyOrder => $itemOrder){
                    $arr_orders_detail = array();
                    foreach ($itemOrder as $keyOrderDetail => $itemOrderDetail){
                        array_push($arr_orders_detail, new OrderDetail(new Food($itemOrderDetail['code'],$itemOrderDetail['name'],null,null,null,null,null),$itemOrderDetail['quantity'],$itemOrderDetail['price']));
                    }
                    array_push($arr_orders,new Order($keyOrder,date("h:i A d/m/yy"),null,$arr_orders_detail));
                }
            }
            if($arr_orders != null && count($arr_orders) != 0) {
                array_push($arr, new Table($key, $item['name'], $arr_orders));
            }
        }
        return $arr;
    }

    public function  updateStatus($table_id,$order_id){
        unset($_SESSION["cart_item"]['code']);
        $this->firebase->getReference('table')->getChild($table_id)->getChild("orders")->push($order_id);
    }

    public function clean($table_id){
        $this->firebase->getReference('table')->getChild($table_id)->getChild("orders")->set(null);
    }
}