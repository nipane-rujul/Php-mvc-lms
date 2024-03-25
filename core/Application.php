<?php

namespace src\core;

class Application{

    public Router $router;
    public Response $response;
    public function __construct(){
        $this->router = new Router(); 
        $this->response = new Response();
    }

    public function run(){
        $path = $this->response->getPath();
        $method = $this->response->getMethod();

        $this->router->disPatch($method,$path);
    }   
}