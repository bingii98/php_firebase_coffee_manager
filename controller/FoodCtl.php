<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './config/Query.php';


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
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $keyList => $itemList){
            foreach ($itemList['food'] as $keyFood => $itemFood){
                array_push($arr,new Food($keyFood,$itemFood['name'],$itemFood['description'],$itemFood['price'],$itemFood['image'],$itemFood['sale'],$itemFood['isSale']));
            }
        }
        return $arr;
    }

    public function get($id, $controller){
        $arr = $controller->getAll_food();
        foreach ($arr as $item) {
            foreach ($item->getFoods() as $itemFood) {
                if($itemFood->getId() == $id)
                    return $itemFood;
            }
        }
        return null;
    }
}