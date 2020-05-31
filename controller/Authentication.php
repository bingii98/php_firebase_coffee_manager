<?php
use Kreait\Firebase\Auth;

class MyService
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = app('firebase.auth');
    }

    public function login($username,$password){
       
    }

}
