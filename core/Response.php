<?php

namespace src\core;
class Response{
    public function redirect($path){
        // echo "h";
        header('Location: '. "/$path");
    }
}