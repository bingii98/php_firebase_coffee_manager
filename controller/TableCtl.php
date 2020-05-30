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
    protected $order_ctl;

    /**
     * UserCtl constructor.
     * @param $firebase
     */
    public function __construct(){
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $firebase = $factory->createDatabase();
        $this->firebase = $firebase;
        if (!class_exists('OrderCtl'))
            $this->order_ctl = new OrderCtl();
    }

    public function getAll(){
        $arr = array();
        $list = $this->firebase->getReference('table')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            array_push($arr,new Table($key,$item['name'],null));
        }
        return $arr;
    }

    public function get($id){
        $this->order_ctl = new OrderCtl();
        $list = $this->firebase->getReference('table')->orderByKey()->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_orders = array();
            if(isset($item['orders'])){
                foreach ($item['orders'] as $key_or => $item_or){
                    array_push($arr_orders,$this->order_ctl->get($item_or));
                }
            }
            return new Table($key,$item['name'],$arr_orders);
        }
        return null;
    }

    public function get_is_food(){
        $arr = array();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_orders = array();
            if(isset($item['orders'])){
                array_push($arr_orders,new Order(null,null,null,null));
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
                array_push($arr_orders,new Order(null,null,null,null));
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
                array_push($arr_orders,new Order(null,null,null,null));
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