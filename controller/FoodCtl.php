<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './config/Query.php';
include_once './model/Food.php';


class FoodCtl{

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
        $list = $this->firebase->getReference('food')->orderByChild('list')->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            array_push($arr,new Food($key,$item['name'],$item['description'],$item['price'],$item['image'],$item['sale'],$item['isSale']));
        }
        return $arr;
    }

    public function get_from_list_id($id){
        $arr = array();
        $list = $this->firebase->getReference('food')->orderByChild('list')->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            array_push($arr,new Food($key,$item['name'],$item['description'],$item['price'],$item['image'],$item['sale'],$item['isSale']));
        }
        return $arr;
    }

    public function get($id){
        $list = $this->firebase->getReference('food')->orderByKey()->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            return new Food($key,$item['name'],$item['description'],$item['price'],$item['image'],$item['sale'],$item['isSale']);
        }
        return null;
    }
}