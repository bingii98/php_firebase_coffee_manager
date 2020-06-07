<?php

use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './config/Query.php';

class MyService
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount('./secret/key.json');
        $this->auth = $factory->createAuth();
    }

    public function login($username, $password)
    {
        try {
            return $this->auth->signInWithEmailAndPassword($username,$password);
        }catch (Exception $e){
            return false;
        }
    }

}
