<?php


class User
{
    private $id;
    private $name;
    private $email;
    private $photo;
    private $isAdmin;
    private $lastSignedIn;
    private $isActive;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $email
     * @param $photo
     * @param $isAdmin
     * @param $lastSignedIn
     * @param $isActive
     */
    public function __construct($id, $name, $email, $photo, $isAdmin, $lastSignedIn, $isActive)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->photo = $photo;
        $this->isAdmin = $isAdmin;
        $this->lastSignedIn = $lastSignedIn;
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
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getLastSignedIn()
    {
        return $this->lastSignedIn;
    }

    /**
     * @param mixed $lastSignedIn
     */
    public function setLastSignedIn($lastSignedIn)
    {
        $this->lastSignedIn = $lastSignedIn;
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