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
            $user_rs = $this->auth->getUserByEmail($username);
            $this->auth->signInWithEmailAndPassword($username,$password);
            return $user_rs;
        }catch (Exception $e){
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
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


    public function check_email_exist($username)
    {
        try {
            $this->auth->getUserByEmail($username);
            return true;
        }catch (Exception $e){
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
        }
    }

    public function change_email_verification($uid, $username)
    {
        try {
            $this->auth->changeUserEmail($uid,$username);
            $this->auth->sendEmailVerificationLink($username);
            return true;
        }catch (Exception $e){
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
        }
    }

    public function send_email_verification($username)
    {
        try {
            $this->auth->sendEmailVerificationLink($username);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

}
