<?php

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
        if($this->orders == null)
            return 0;
        return count($this->orders);
    }
}
