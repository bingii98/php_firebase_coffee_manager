<?php
class Order{
    private $id;
    private $food_id;
    private $table_id;
    private $order_details;

    /**
     * Order constructor.
     * @param $id
     * @param $food_id
     * @param $table_id
     * @param $order_details
     */
    public function __construct($id, $food_id, $table_id, $order_details)
    {
        $this->id = $id;
        $this->food_id = $food_id;
        $this->table_id = $table_id;
        $this->order_details = $order_details;
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
    public function getFoodId()
    {
        return $this->food_id;
    }

    /**
     * @param mixed $food_id
     */
    public function setFoodId($food_id)
    {
        $this->food_id = $food_id;
    }

    /**
     * @return mixed
     */
    public function getTableId()
    {
        return $this->table_id;
    }

    /**
     * @param mixed $table_id
     */
    public function setTableId($table_id)
    {
        $this->table_id = $table_id;
    }

    /**
     * @return mixed
     */
    public function getOrderDetails()
    {
        return $this->order_details;
    }

    /**
     * @param mixed $order_details
     */
    public function setOrderDetails($order_details)
    {
        $this->order_details = $order_details;
    }


}