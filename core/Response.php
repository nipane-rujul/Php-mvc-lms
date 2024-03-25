<?php

namespace src\core;

class Response{

    public function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath(){
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }
}