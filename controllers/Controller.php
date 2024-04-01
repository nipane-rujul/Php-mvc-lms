<?php

namespace src\controllers;
class Controller{
    protected function render($view,$params = [], $error = []){
        echo $this->renderView($view,$params,$error);
    }

    public function renderView($view, $params = []){
        $layoutContent = $this->layoutContent($params);
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}",$viewContent,$layoutContent);
    }

    protected function layoutContent($params){
        foreach($params as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once "../views/layouts/header.php";
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