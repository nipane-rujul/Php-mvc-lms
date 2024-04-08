<?php

namespace src\core;

class Request
{

    // get url method 
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    // get url 
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    // get form data 
    public function getBody()
    {
        $data = [];
        if ($this->getMethod() == "GET") {
            foreach ($_GET as $key => $value) {
                
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() == "POST") {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $data;
    }
}
