<?php

namespace src\controllers;

use src\core\Application;

class Installation extends Controller{

    public function install(){
        if(Application::$app->request->getMethod() == "POST"){
            
        }
        else{
            $this->layout = 'auth';
            $this->render("install");
        }
    }

}