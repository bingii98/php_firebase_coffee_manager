<?php
class Order{
    private $id;
    private $table_id;
    private $order_details;

    /**
     * Order constructor.
     * @param $id
     * @param $table_id
     * @param $order_details
     */
    public function __construct($id, $table_id, $order_details)
    {
        $this->id = $id;
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