<?php

namespace src\core\middlewares;
use src\core\Application;

class AdminMiddleware{
    public function handle(){
        echo "here";
        if(!Application::$app->isAdmin()){
            

        }
    }
}