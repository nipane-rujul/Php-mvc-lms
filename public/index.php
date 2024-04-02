<?php

use src\controllers\AuthController;
use src\core\Application;
// echo "here";
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// echo "here";
$config = [
    // 'userClass' => \app\models\User::class,
    'db' => [
        'server' => $_ENV['DB_SERVER'],
        'dbuser' => $_ENV['DB_USER'],
        'dbpass' => $_ENV['DB_PASS'],
        'dbname' => $_ENV['DB_NAME']
    ]
];

// echo 'here';

$app = new Application($config);
$app->router->get('/',[AuthController::class,'home']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->post('/register',[AuthController::class,'register']);
$app->run();