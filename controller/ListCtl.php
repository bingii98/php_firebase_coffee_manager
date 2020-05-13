<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';

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
        $lists = array();
        $list = $this->firebase->getReference('list')->orderByKey()->getSnapshot();
        foreach ($list->getChild() as $item){
            echo $item->getValue();
        }
    }
}
