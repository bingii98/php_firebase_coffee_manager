<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './model/Table.php';
include './model/Food.php';

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
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_food = array();
            if(isset($item['foods'])){
                foreach ($item['foods'] as $keyFood => $itemFood){
                    array_push($arr_food,new Food($keyFood,$itemFood['name'],$itemFood['description'],$itemFood['price'],$itemFood['image'],$itemFood['sale'],$itemFood['isSale']));
                }
            }
            array_push($arr,new Table($key,$item['name'],$arr_food));
        }
        return $arr;
    }

    public function get_empty_food(){
        $arr = array();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_food = array();
            if(isset($item['foods'])){
                foreach ($item['foods'] as $keyFood => $itemFood){
                    array_push($arr_food,new Food($keyFood,$itemFood['name'],$itemFood['description'],$itemFood['price'],$itemFood['image'],$itemFood['sale'],$itemFood['isSale']));
                }
            }
            if($arr_food == null || count($arr_food) == 0){
                array_push($arr,new Table($key,$item['name'],$arr_food));
            }
        }
        return $arr;
    }

    public function get_not_empty_food(){
        $arr = array();
        $list = $this->firebase->getReference('table')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $arr_food = array();
            if(isset($item['foods'])){
                foreach ($item['foods'] as $keyFood => $itemFood){
                    array_push($arr_food,new Food($keyFood,$itemFood['name'],$itemFood['description'],$itemFood['price'],$itemFood['image'],$itemFood['sale'],$itemFood['isSale']));
                }
            }
            if($arr_food != null && count($arr_food) != 0){
                array_push($arr,new Table($key,$item['name'],$arr_food));
            }
        }
        return $arr;
    }
}