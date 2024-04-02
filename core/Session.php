<?php
namespace src\core;

class Session{

    public function __construct(){
        session_start();
    }

    public function setFlash(){

    }

    public function getFlash(){

    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return $_SESSION[$key];
    }
}