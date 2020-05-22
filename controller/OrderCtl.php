<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include_once './model/Table.php';
include_once './model/Food.php';
include_once './controller/TableCtl.php';

class OrderCtl{

    protected $firebase;
    protected $tableCtl;

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

    public function insert($table_id){
        if(isset($_SESSION["cart_item"])){
            $result = $this->firebase->getReference('orders')->push($_SESSION["cart_item"]);
            $this->tableCtl = new TableCtl();
            $this->tableCtl->updateStatus($table_id,$result->getSnapshot()->getKey());
        }
    }

    public function countFood($id){
        $list = $this->firebase->getReference('orders')->getChild($id)->getSnapshot()->getValue();
        $count = 0;
        foreach ($list as $key => $value){
            $count++;
        }
        return $count;
    }
}