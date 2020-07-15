<?php

class Drink{
    private $id;
    private $name;
    private $discription;
    private $price;
    private $image;
    private $sale;
    private $isSale;
    private $isActive;

    /**
     * Food constructor.
     * @param $id
     * @param $name
     * @param $discription
     * @param $price
     * @param $image
     * @param $sale
     * @param $isSale
     * @param $isActive
     */
    public function __construct($id, $name, $discription, $price, $image, $sale, $isSale, $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->discription = $discription;
        $this->price = $price;
        $this->image = $image;
        $this->sale = $sale;
        $this->isSale = $isSale;
        $this->isActive = $isActive;
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
    public function getDiscription()
    {
        return $this->discription;
    }

    /**
     * @param mixed $discription
     */
    public function setDiscription($discription)
    {
        $this->discription = $discription;
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * @param mixed $sale
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
    }

    /**
     * @return mixed
     */
    public function getIsSale()
    {
        return $this->isSale;
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
    public function printIsSale()
    {
        if($this->isSale == 1){
            return "Sealing";
        }
        return "Not sale";
    }

    /**
     * @param mixed $isSale
     */
    public function setIsSale($isSale)
    {
        $this->isSale = $isSale;
    }


}