<?php

namespace src\core;
class Response{
    // redirecting to the page 
    public function redirect($path){
        header('Location: '. "/$path");
    }
}