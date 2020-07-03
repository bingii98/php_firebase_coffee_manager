<?php
class Order{
    private $id;
    private $date;
    private $staff;
    private $order_details;
    private $status;

    /**
     * Order constructor.
     * @param $id
     * @param $date
     * @param $staff
     * @param $order_details
     * @param $status
     */
    public function __construct($id, $date, $staff, $order_details, $status)
    {
        $this->id = $id;
        $this->date = $date;
        $this->staff = $staff;
        $this->order_details = $order_details;
        $this->status = $status;
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
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * @param mixed $staff
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;
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
     * @param mixed $staff
     */
    public function revenueCount()
    {
       return array_reduce($this->getOrderDetails(), function ($carry, $value) {
               return $carry + $value->getPrice()*$value->getNum();
           return $carry;
       });
    }

    /**
     * @param mixed $staff
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
        $DATA['staff'] = $this->staff;
        $DATA['status'] = 'pending';
        $arr_order_detail = array();
        foreach ($this->order_details as $key => $item){
            $arr_ordt = array($key => array('num' => $item->getNum(), 'price' => $item->getPrice(), 'food' => $item->getFood()->getId()));
            $arr_order_detail = array_merge($arr_order_detail,$arr_ordt);
        }
        $DATA['detail'] = $arr_order_detail;
        return $DATA;
    }
}