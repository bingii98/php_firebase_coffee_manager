<?php
class Order{
    private $id;
    private $date;
    private $user;
    private $order_details;

    /**
     * Order constructor.
     * @param $id
     * @param $date
     * @param $user
     * @param $order_details
     */
    public function __construct($id, $date, $user, $order_details)
    {
        $this->id = $id;
        $this->date = $date;
        $this->user = $user;
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

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getuser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setuser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $user
     */
    public function revenueCount()
    {
       return array_reduce($this->getOrderDetails(), function ($carry, $value) {
               return $carry + $value->getPrice()*$value->getNum();
           return $carry;
       });
    }

    /**
     * @param mixed $user
     */
    public function foodCount()
    {
        return array_reduce($this->getOrderDetails(), function ($carry, $value) {
            return $carry + $value->getNum();
            return $carry;
        });
    }

    public function pushFB(){
        $DATA['date'] = $this->date;
        $DATA['user'] = $this->user;
        $arr_order_detail = array();
        foreach ($this->order_details as $key => $item){
            $arr_ordt = array($key => array('num' => $item->getNum(), 'price' => $item->getPrice(), 'food' => $item->getFood()->getId()));
            $arr_order_detail = array_merge($arr_order_detail,$arr_ordt);
        }
        $DATA['detail'] = $arr_order_detail;
        return $DATA;
    }
}