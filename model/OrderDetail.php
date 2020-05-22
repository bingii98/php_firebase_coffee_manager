<?php
class OrderDetail{
    private $food;
    private $num;
    private $price;

    /**
     * OrderDetail constructor.
     * @param $food
     * @param $num
     * @param $price
     */
    public function __construct($food, $num, $price)
    {
        $this->food = $food;
        $this->num = $num;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @param mixed $food
     */
    public function setFood($food)
    {
        $this->food = $food;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num)
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}