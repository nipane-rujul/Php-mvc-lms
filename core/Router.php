<?php


namespace src\core;


class Router{

    protected $routes = [];

    // storing get routes 
    public function get($route, $controller)
    {
        $this->routes['GET'][$route] = $controller;
    }

    // storing post routes  
    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    // calling controller method of particular route 
    public function disPatch($method,$path){
        $callback = $this->routes[$method][$path] ?? false;
        if(!$callback){
           Application::$app->response->redirect('404');
        }
        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            $callback[0] = $controller;
        }

        return call_user_func($callback);
        
    }
  

}