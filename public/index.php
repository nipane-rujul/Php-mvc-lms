<?php


require_once "../vendor/autoload.php";

use src\controllers\AuthController;
use src\core\Application;

$app = new Application();

$app->router->get('/','home');
$app->router->get('/login','login');


$app->run();