<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include_once './model/Table.php';
include_once './model/Drink.php';
include_once './model/Order.php';
include_once './model/User.php';
include_once './model/OrderDetail.php';
include_once './controller/TableCtl.php';
include_once './controller/ListCtl.php';
include_once './controller/DrinkCtl.php';


class OrderCtl
{

    protected $firebase;
    protected $table_ctl;
    protected $food_ctl;
    protected $auth;

    /**
     * UserCtl constructor.
     * @param $firebase
     */
    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $this->firebase = $factory->createDatabase();
        $this->auth = $factory->createAuth();
    }

    public function getFirst10()
    {
        $list = $this->firebase->getReference('orders')->orderByKey()->limitToLast(10)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list as $key => $item){
            $arr_detail = array();
            foreach ($item['detail'] as $value) {
                array_push($arr_detail, new OrderDetail($value['food'], $value['num'], $value['price']));
            }
            array_push($arr,new Order($key, $item['date'], (isset($item['staff']) != null) ? $item['staff'] : null, $arr_detail,(isset($value['status']) ? $value['status'] : null)));
        }
        return array_reverse($arr);
    }

    public function getContinue10($idLast)
    {
        $list = $this->firebase->getReference('orders')->orderByKey()->endAt($idLast)->limitToLast(11)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list as $key => $item){
            $arr_detail = array();
            foreach ($item['detail'] as $value) {
                array_push($arr_detail, new OrderDetail($value['food'], $value['num'], $value['price']));
            }
            array_push($arr,new Order($key, $item['date'], (isset($item['staff']) != null) ? $item['staff'] : null, $arr_detail,(isset($value['status']) ? $value['status'] : null)));
        }
        return array_reverse($arr);
    }

    public function insert($table_id, $uid)
    {
        $this->food_ctl = new DrinkCtl();
        $this->table_ctl = new TableCtl();
        $arr_order_detail = array();
        $date = new DateTime();
        foreach ($_SESSION["cart_item"] as $key => $item) {
            array_push($arr_order_detail, new OrderDetail($this->food_ctl->get($key), $item['quantity'], $item['price']));
        }
        $order = new Order(null, $date->getTimestamp(), null, $arr_order_detail,(isset($value['status']) ? $value['status'] : null));
        if (isset($_SESSION["cart_item"])) {
            $result = $this->firebase->getReference('orders')->push($order->pushFB());
            $this->table_ctl->updateStatus($table_id, $result->getSnapshot()->getKey());
        }
    }

    public function order_generation($uid,$date)
    {
        $this->food_ctl = new DrinkCtl();
        $this->table_ctl = new TableCtl();
        $arr_order_detail = array();
        foreach ($_SESSION["cart_item"] as $key => $item) {
            array_push($arr_order_detail, new OrderDetail($this->food_ctl->get($key), $item['quantity'], $item['price']));
        }
        $order = new Order(null, $date, $uid, $arr_order_detail,(isset($value['status']) ? $value['status'] : null));
        if (isset($_SESSION["cart_item"])) {
            $result = $this->firebase->getReference('orders')->push($order->pushFB());
        }
    }

    public function get($id)
    {
        $this->food_ctl = new DrinkCtl();
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        $arr = array();
        if(isset($list['staff'])){
            $a = $this->auth->getUser($list['staff']);
            $user = new User($a->uid,$a->displayName,$a->email,null,null,null,null);
        }else{
            $a = null;
            $user = new User(null,null,null,null,null,null,null);
        }
        foreach ($list['detail'] as $value) {
            array_push($arr, new OrderDetail($this->food_ctl->get($value['food']), $value['num'], $value['price']));
        }
        return new Order($id, $list['date'], $user, $arr,(isset($list['status']) ? $list['status'] : null));
    }


    public function get_date($date)
    {
        $this->food_ctl = new DrinkCtl();
        $list = $this->firebase->getReference('orders')->orderByChild('date')->equalTo($date)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list as $key => $item){
            $arr_detail = array();
            foreach ($item['detail'] as $value) {
                array_push($arr_detail, new OrderDetail($value['food'], $value['num'], $value['price']));
            }
            array_push($arr,new Order($key, $item['date'], null, $arr_detail,(isset($value['status']) ? $value['status'] : null)));
        }
        return $arr;
    }

    public function get_range_date($dstart,$dstop)
    {
        $this->food_ctl = new DrinkCtl();
        $list = $this->firebase->getReference('orders')->orderByChild('date')->startAt($dstart)->endAt($dstop)->getSnapshot()->getValue();
        $arr = array();
        foreach ($list as $key => $item){
            $arr_detail = array();
            foreach ($item['detail'] as $value) {
                array_push($arr_detail, new OrderDetail($value['food'], $value['num'], $value['price']));
            }
            array_push($arr,new Order($key, $item['date'], null, $arr_detail,(isset($value['status']) ? $value['status'] : null)));
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

    public function count_sales_week($array, $date){
        $a = array_reduce($array, function ($carry, $value) use ($date) {
            if (date('d-m-yy',$value->getDate()) == $date){
                return $carry + $value->revenueCount();
            }
            return $carry;
        });
        if($a == null)
            return 0;
        return $a;
    }

    public function empty()
    {
        $list = $this->firebase->getReference('orders')->set(null);
        return 0;
    }

    public function updateStatusNull($id)
    {
        try {
            $this->firebase->getReference('orders/' . $id)->update([
                'status' => null
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}