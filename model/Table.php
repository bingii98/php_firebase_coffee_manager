<?php

include_once './controller/OrderCtl.php';

class Table {
    private $id;
    private $name;
    private $orders = array();

    /**
     * Table constructor.
     * @param $id
     * @param $name
     * @param $orders
     */
    public function __construct($id, $name, $orders)
    {
        $this->id = $id;
        $this->name = $name;
        $this->orders = $orders;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param mixed $foods
     */
    public function setFoods($orders)
    {
        $this->orders = $orders;
    }

    /**
     * @return mixed
     */
    public function countOrder()
    {
        $count = 0;
        foreach ($this->orders as $key => $value){
            foreach ($value->getOrderDetails() as $keyDt => $valueDt){
                $count += $valueDt->getNum();
            }
        }
        return $count;
    }

    /**
     * @return mixed
     */
    public function loadDataFoodDetail()
    {
        $string = "";
        $tolal = 0;
        foreach ($this->orders as $key => $value){
            foreach ($value->getOrderDetails() as $keyDt => $valueDt){
                $string = $string.'<tr><td><strong>'.$valueDt->getFood()->getName().'</strong></td><td>'.$valueDt->getNum().'</td><td align="right">'.$valueDt->getNum().'</td></tr>';
                $tolal += $valueDt->getNum()*$valueDt->getPrice();
            }
        }
        $string = $string.'<td align="right">'.$tolal.'</td>';
        return $string;
    }
}
