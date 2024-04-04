<?php
namespace src\core;

class Session{
    public static $errors = [];
    public function __construct(){
        session_start();
    }

    public function setFlash($message){
        $_SESSION['flash'] = $message;
    }

    public function getFlash(){
        return $_SESSION['flash']?: false;
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return $_SESSION[$key]?: false;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }

    public function deleteSession(){
        unset($_SESSION);
        session_destroy();
    }
}