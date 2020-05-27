<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';

//Module
include_once './model/List.php';
include_once './model/Food.php';
include_once './controller/FoodCtl.php';

class ListCtl{

    protected $firebase;
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
        $this->food_ctl = new FoodCtl();
    }


    public function getAll(){
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByChild('food')->getSnapshot()->getValue();
        foreach ($list as $keyList => $itemList) {
            array_push($arr_list,new Lists($keyList,$itemList['name'],null));
        }
        return $arr_list;
    }


    public function getAll_food(){
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            $arr_food = $this->food_ctl->get_from_list_id($key);
            array_push($arr_list,new Lists($key,$item['name'],$arr_food));
        }
        return $arr_list;
    }
}
