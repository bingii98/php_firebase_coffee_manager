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
            $this->auth->signInWithEmailAndPassword($username,$password);
            return $this->auth->getUserByEmail($username);
        }catch (Exception $e){
            return false;
        }
    }

    public function forgot_password($username)
    {
        try {
            $this->auth->sendPasswordResetLink($username);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

}
