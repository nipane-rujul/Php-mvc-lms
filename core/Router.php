<?php


namespace src\core;


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

    
    public function renderView($view, $params = []){
        include_once "../views/$view.php";
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