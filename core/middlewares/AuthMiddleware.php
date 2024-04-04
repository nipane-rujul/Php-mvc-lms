<?php
namespace src\core\middlewares;
use src\core\Application;

class AuthMiddleware{
    public function handle(){
        if(!Application::$app->isLogin()){
            Application::$app->response->redirect('login');
        }
    }
    
}