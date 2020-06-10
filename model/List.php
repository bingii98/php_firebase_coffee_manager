<?php

class Lists {
    private $id;
    private $name;
    private $description;
    private $foods = array();

    /**
     * Lists constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param array $foods
     */
    public function __construct($id, $name, $description, array $foods)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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

    /**
     * @return mixed
     */
    public function countFood()
    {
        return count($this->foods);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}