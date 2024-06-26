<?php

use src\controllers\AuthController;
use src\controllers\CourseController;
use src\controllers\AdminController;
use src\controllers\ErrorController;
use src\controllers\Installation;
use src\core\Application;
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if($_ENV['DB_SERVER'] == null){
    $config = null;
}
else{
    $config = [
        'db' => [
            'server' => $_ENV['DB_SERVER'],
            'dbuser' => $_ENV['DB_USER'],
            'dbpass' => $_ENV['DB_PASS'],
            'dbname' => $_ENV['DB_NAME']
        ]
    ];
}

$app = new Application($config);
$app->router->get('/installation',[Installation::class,'install']);
$app->router->get('/',[CourseController::class,'home']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/login',[AuthController::class,'login']);
$app->router->get('/logout',[AuthController::class,'logout']);
$app->router->post('/register',[AuthController::class,'register']);
$app->router->get('/course',[CourseController::class,'course']);
$app->router->get('/getCourses',[CourseController::class,'getCourses']);
$app->router->get('/403',[ErrorController::class,'error403']);
$app->router->get('/404',[ErrorController::class,'error404']);
$app->router->get('/CreateCourse',[AdminController::class,'CreateCourse']);
$app->router->post('/CreateCourse',[AdminController::class,'CreateCourse']);
$app->router->get('/editCourse',[AdminController::class,'editCourse']);
$app->router->post('/editCourse',[AdminController::class,'editCourse']);
$app->router->post('/getCourseDetails',[CourseController::class,'getCourseDetails']);
$app->router->post('/deleteCourse',[AdminController::class,'deleteCourse']);
$app->router->post('/addSection',[AdminController::class,'addSection']);
$app->router->post('/addVideo',[AdminController::class,'addVideo']);
$app->router->post('/deleteCourse',[AdminController::class,'deleteCourse']);
$app->router->post('/deleteSection',[AdminController::class,'deleteSection']);
$app->router->post('/deleteVideo',[AdminController::class,'deleteVideo']);
$app->run();
