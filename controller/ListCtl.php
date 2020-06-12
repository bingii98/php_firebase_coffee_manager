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


    public function get($id)
    {
        $list = $this->firebase->getReference('list')->orderByKey()->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            return new Lists($key, $item['name'], $item['description'], $item['isActive'],array());
        }
        return null;
    }


    public function getAll(){
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            array_push($arr_list,new Lists($key,$item['name'],$item['description'],$item['isActive'],array()));
        }
        return $arr_list;
    }


    public function getAll_food(){
        $arr_list = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot()->getValue();
        foreach ($list as $key => $item){
            $arr_food = $this->food_ctl->get_from_list_id($key);
            array_push($arr_list,new Lists($key,$item['name'],$item['description'],$item['isActive'],$arr_food));
        }
        return $arr_list;
    }

    public function get_by_name($name)
    {
        $list = $this->firebase->getReference('list')->orderByChild('name')->equalTo($name)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            return new Lists($key, $item['name'], $item['description'], $item['isActive'],array());
        }
        return null;
    }


    public function delete($id)
    {
        try {
            $this->firebase->getReference('list/' . $id)->update([
                'isActive' => false
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function reactive($id)
    {
        try {
            $this->firebase->getReference('list/' . $id)->update([
                'isActive' => true
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function insert($list)
    {
        try {
            $this->firebase->getReference('list')->push([
                'description' => $list->getDescription(),
                'isActive' => true,
                'name' => $list->getName(),
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($list)
    {
        try {
            $this->firebase->getReference('list/' . $list->getId())->update([
                'description' => $list->getDescription(),
                'name' => $list->getName(),
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
