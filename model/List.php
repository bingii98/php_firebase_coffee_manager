<?php

class Lists {
    private $id;
    private $name;
    private $foods;


    /**
     * Lists constructor.
     * @param $id
     * @param $name
     * @param $foods
     */
    public function __construct($id, $name, $foods)
    {
        $this->id = $id;
        $this->name = $name;
        $this->foods = $foods;
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
    public function getFoods()
    {
        return $this->foods;
    }

    /**
     * @param mixed $foods
     */
    public function setFoods($foods)
    {
        $this->foods = $foods;
    }


}