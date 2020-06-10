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


class OrderCtl
{

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
    }

    public function insert($table_id, $uid)
    {
        $this->food_ctl = new FoodCtl();
        $this->table_ctl = new TableCtl();
        $arr_order_detail = array();
        $date = new DateTime();
        foreach ($_SESSION["cart_item"] as $key => $item) {
            array_push($arr_order_detail, new OrderDetail($this->food_ctl->get($key), $item['quantity'], $item['price']));
        }
        $order = new Order(null, $date->getTimestamp(), $uid, $arr_order_detail);
        if (isset($_SESSION["cart_item"])) {
            $result = $this->firebase->getReference('orders')->push($order->pushFB());
            $this->table_ctl->updateStatus($table_id, $result->getSnapshot()->getKey());
        }
    }

    public function get($id)
    {
        $this->food_ctl = new FoodCtl();
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list['detail'] as $value) {
            array_push($arr, new OrderDetail($this->food_ctl->get($value['food']), $value['num'], $value['price']));
        }
        return new Order($id, $list['date'], $list['staff'], $arr);
    }

    public function get_range_date($dstart,$dstop)
    {
        $this->food_ctl = new FoodCtl();
        $list = $this->firebase->getReference('orders')->orderByChild('date')->startAt($dstart)->endAt($dstop)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list as $key => $item){
            $arr_detail = array();
            foreach ($item['detail'] as $value) {
                array_push($arr_detail, new OrderDetail($value['food'], $value['num'], $value['price']));
            }
            array_push($arr,new Order($key, $item['date'], $item['staff'], $arr_detail));
        }
        return $arr;
    }

    public function countFood($id)
    {
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        if ($list != null)
            return $list['detail'];
        return 0;
    }

    public function count_sales_week($array, $beforeDate){
        $a = array_reduce($array, function ($carry, $value) use ($beforeDate) {
            $matchDateWeek = $d = DateTime::createFromFormat('d-m-Y H:i:s', ''. date("d-m-yy", strtotime('-'.$beforeDate.' days')) . ' 00:00:00', new DateTimeZone('UTC'));
            if (date('d-m-yy',$value->getDate()) == date('d-m-yy',$matchDateWeek->getTimestamp())) return $carry + $value->revenueCount();
            return $carry;
        });
        if($a == null)
            return 0;
        return $a;
    }
}