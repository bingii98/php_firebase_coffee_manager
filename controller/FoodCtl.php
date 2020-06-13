<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require_once './vendor/autoload.php';
require_once './config/Query.php';
require_once './model/Food.php';


class FoodCtl
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

    public function getAll()
    {
        $arr = array();
        $list = $this->firebase->getReference('food')->orderByChild('list')->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            array_push($arr, new Food($key, $item['name'], $item['description'], $item['price'], $item['image'], $item['sale'], $item['isSale'], $item['isActive']));
        }
        return $arr;
    }

    public function get_from_list_id($id)
    {
        $arr = array();
        $list = $this->firebase->getReference('food')->orderByChild('list')->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
                array_push($arr, new Food($key, $item['name'], $item['description'], $item['price'], $item['image'], $item['sale'], $item['isSale'], $item['isActive']));
        }
        return $arr;
    }

    public function get_is_empty_food($idList)
    {
        $count = 0;
        $list = $this->firebase->getReference('food')->orderByChild('list')->equalTo($idList)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            $count++;
        }
        if($count == 0)
            return 'true';
        return 'false';
    }


    public function get_by_name($name)
    {
        $list = $this->firebase->getReference('food')->orderByChild('name')->equalTo($name)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            return new Food($key, $item['name'], $item['description'], $item['price'], $item['image'], $item['sale'], $item['isSale'], $item['isActive']);
        }
        return null;
    }


    public function get($id)
    {
        $list = $this->firebase->getReference('food')->orderByKey()->equalTo($id)->getSnapshot()->getValue();
        foreach ($list as $key => $item) {
            return new Food($key, $item['name'], $item['description'], $item['price'], $item['image'], $item['sale'], $item['isSale'], $item['isActive']);
        }
        return null;
    }


    public function delete($id)
    {
        try {
            $this->firebase->getReference('food/' . $id)->update([
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
            $this->firebase->getReference('food/' . $id)->update([
                'isActive' => true
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function insert($food, $list)
    {
        try {
            $this->firebase->getReference('food')->push([
                'description' => $food->getDiscription(),
                'image' => $food->getImage(),
                'isActive' => true,
                'isSale' => (($food->getIsSale()) == 'true' ? true : false),
                'list' => $list,
                'name' => $food->getName(),
                'price' => $food->getPrice(),
                'sale' => $food->getSale()
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($food)
    {
        try {
            $this->firebase->getReference('food/' . $food->getId())->update([
                'description' => $food->getDiscription(),
                'isSale' => (($food->getIsSale()) == 'true' ? true : false),
                'name' => $food->getName(),
                'price' => $food->getPrice(),
                'sale' => $food->getSale()
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}