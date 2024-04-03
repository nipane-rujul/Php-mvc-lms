<?php

namespace src\core;

class Request
{

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }


    public function getBody()
    {
        $data = [];
        // echo "here";
        if ($this->getMethod() == "GET") {
            // var_dump($_GET);
            foreach ($_GET as $key => $value) {
                
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() == "POST") {
            // var_dump($_POST);
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        // var_dump($data);
        return $data;
    }
}
