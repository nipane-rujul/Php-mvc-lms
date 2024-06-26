<?php

namespace src\core;

use src\controllers\Installation;
use src\models\Database;

class Application{
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public static Application $app;
    public Session $session;
    public function __construct($config = []){
        // initializing the necessary classes 
        $this->router = new Router(); 
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        self::$app = $this;
        if(!$config){
            $installation = new Installation();
            $installation->install();
        }
        else{
            $this->db = Database::getInstance($config['db']);
            self::$app->db->getConnection();
        }

    }

    public function run(){
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $this->router->disPatch($method,$path);
    }   

    public function isAdmin(){
        $user = $this->session->get('user');
        if($user['isAdmin'] == 'yes'){
            return true;
        }
        return false;
    }

    public function isLogin(){
        if($this->session->get('user')){
            return true;
        }
        return false;
    }

    public function getName(){
        $user = $this->session->get('user');
        if($user['isAdmin'] == 'yes') return "Admin";
        return $user['username'];
    }

    public function getMessage(){
        $message = $this->session->getFlash();
        $this->session->remove('flash');
        return $message;
    }
}