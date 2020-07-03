<?php

include_once './controller/OrderCtl.php';

class Table {
    private $id;
    private $name;
    private $isActive;
    private $status;
    private $orders = array();

    /**
     * Table constructor.
     * @param $id
     * @param $name
     * @param $isActive
     * @param $status
     * @param array $orders
     */
    public function __construct($id, $name, $isActive, $status, array $orders)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isActive = $isActive;
        $this->status = $status;
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
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param array $orders
     */
    public function setOrders(array $orders)
    {
        $this->orders = $orders;
    }


    /**
     * @return mixed
     */
    public function countOrder()
    {
        return count($this->orders);
    }

    /**
     * @return mixed
     */
    public function countFood()
    {
        $count = 0;
        foreach ($this->orders as $item)
            if(count($item->getOrderDetails()) > 0)
                $count += count($item->getOrderDetails());
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
                $string = $string.'<tr><td><strong>'.$valueDt->getFood()->getName().'</strong></td><td>'.$valueDt->getNum().'</td><td align="right">'.number_format($valueDt->getPrice(), 0, "", ".").' ₫</td></tr>';
                $tolal += $valueDt->getNum()*$valueDt->getPrice();
            }
        }
        $string = $string.'<td align="right" colspan="3"><strong>Total</strong> '.number_format($tolal, 0, "", ".").' ₫</td>';
        return $string;
    }
}
