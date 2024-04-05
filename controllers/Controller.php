<?php

namespace src\controllers;
use src\core\Session;

use src\core\Application;

class Controller{

    protected $layout = "main";

    protected function setError($error){
        Application::$app->session->set('error',$error);
    }
    protected function render($view,$params = []){
        echo $this->renderView($view,$params);
    }

    public function renderView($view, $params = []){
        $layoutContent = $this->layoutContent($params);
        $error = Application::$app->session->get('error');
        Application::$app->session->remove('error');
        $viewContent = $this->renderOnlyView($view, $params,$error);
        return str_replace("{{content}}",$viewContent,$layoutContent);
    }

    protected function layoutContent($params){
        $layout = $this->layout;
        foreach($params as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once "../views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params, $errors = []){
        foreach($params as $key=>$value){
            $$key = $value;

        }
        foreach($errors as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once "../views/$view.php";
        return ob_get_clean();
    }

}