<?php

use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require './vendor/autoload.php';
include './config/Query.php';

class Authentication
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
            $this->auth->signInWithEmailAndPassword($username, $password);
            return $user_rs;
        } catch (Exception $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return false;
        }
    }

    public function forgot_password($username)
    {
        try {
            $this->auth->sendPasswordResetLink($username);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function check_email_exist($username)
    {
        try {
            $this->auth->getUserByEmail($username);
            return true;
        } catch (Exception $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return false;
        }
    }

    public function change_email_verification($uid, $username)
    {
        try {
            $properties = [
                'emailVerified' => false
            ];
            $this->auth->changeUserEmail($uid, $username);
            $this->auth->updateUser($uid,$properties);
            $this->auth->sendEmailVerificationLink($username);
            return true;
        } catch (Exception $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return false;
        }
    }

    public function change_name_display($uid, $name)
    {
        try {
            $properties = [
                'displayName' => $name
            ];
            $this->auth->updateUser($uid,$properties);
            return true;
        } catch (Exception $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return false;
        }
    }

    public function send_email_verification($username)
    {
        try {
            $this->auth->sendEmailVerificationLink($username);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function set_admin($uid,$value)
    {
        try {
            $this->auth->setCustomUserAttributes($uid, ['admin' => $value]);
            return true;
        } catch (Exception $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return false;
        } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
            return false;
        }
    }

}
