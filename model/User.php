<?php


class User
{
    private $id;
    private $name;
    private $email;
    private $photo;
    private $lastSignedIn;
    private $isActive;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $email
     * @param $photo
     * @param $lastSignedIn
     * @param $isActive
     */
    public function __construct($id, $name, $email, $photo, $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->photo = $photo;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
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
}