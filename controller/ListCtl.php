<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';

//Module
include_once './model/List.php';
include_once './model/Food.php';

class ListCtl{

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
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $keyList => $itemList) {
            array_push($arr_list,new Lists($keyList,$itemList['name'],null));
        }
        return $arr_list;
    }


    public function getAll_food(){
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $keyList => $itemList){
            $arr_food = array();
            foreach ($itemList['food'] as $keyFood => $itemFood){
                array_push($arr_food,new Food($keyFood,$itemFood['name'],$itemFood['description'],$itemFood['price'],$itemFood['image'],$itemFood['sale'],$itemFood['isSale']));
            }
            array_push($arr_list,new Lists($keyList,$itemList['name'],$arr_food));
        }
        return $arr_list;
    }
}
