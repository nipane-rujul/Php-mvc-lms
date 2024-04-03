<?php

namespace src\core;
class Response{
    public function redirect($path){
        header('Location: '. "/$path");
    }
}