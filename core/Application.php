<?php

namespace src\core;
use src\models\Database;

class Application{
    public Router $router;
    public Request $request;
    public Database $db;
    public static Application $app;

    public Session $session;

    public function __construct($config){
 
        $this->router = new Router(); 
        $this->request = new Request();
        $this->db = Database::getInstance($config['db']);
        $this->session = new Session();
        // echo "here";
        self::$app = $this;
        self::$app->db->getConnection();
        // echo "here";
        
    }

    public function run(){
        // echo "here";
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $this->router->disPatch($method,$path);
    }   
}