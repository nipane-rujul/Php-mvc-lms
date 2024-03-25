<?php


namespace src\core;
use Controller;

class Router{

    protected $routes = [];

    public function get($route, $controller)
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function post($route, $controller)
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function disPatch($method,$path){
        // echo "here";
        var_dump($this->routes);
        echo $method . $path;
        $callback = $this->routes[$method][$path] ?? false;
        // echo $callback;
        
        if (is_string($callback)) {
            return $this->renderView($callback);
        }/*
        if (is_array($callback)) {
            /**
             * @var $controller \thecodeholic\phpmvc\Controller
             
            $controller = new $callback[0];
            $controller->action = $callback[1];
            // Application::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback);
        */
    }

    
    public function renderView($view, $params = []){
        include_once "../views/$view.php";
        // $layoutContent = $this->layoutContent();
        // $viewContent = $this->renderOnlyView($view, $params);
        // return str_replace("{{content}}",$viewContent,$layoutContent);
    }

    protected function layoutContent(){
        // $layout = Application::$app->controller->layout;
        ob_start();
        // include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params){
        foreach($params as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once "../views/$view.php";
        return ob_get_clean();
    }

}