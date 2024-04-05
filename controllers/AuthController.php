<?php

namespace src\controllers;
use src\core\Application;
use src\models\User;
use src\core\Session;

class AuthController extends Controller{

    public function __construct(){
        if(Application::$app->isLogin()){
            Application::$app->response->redirect('');
        }
    }

    
    public function login(){

        if(Application::$app->request->getMethod() == 'POST'){
            $data = Application::$app->request->getBody();
            try{
                $user = User::getUser(array("username"=> $data["username"]));
            }
            catch(\Exception $e){
                Application::$app->session->setFlash($e->getMessage());
                Application::$app->response->redirect('login');
                exit;
            }
            
            if($user->num_rows == 0){
                $error = ['message' => 'Invalid username or password', 'data' => $data];
                $this->setError($error);
                Application::$app->session->setFlash(["message"=>'Login failed', "type" => "danger"]);
                Application::$app->response->redirect('login'); 
                exit;
            }
            else{
                // login the user by verifying password
                $row = $user->fetch_assoc();
                if(User::Login($row,$data["password"])){
                    Application::$app->session->setFlash(["message"=>'Login Successfully', "type" => "success"]);
                    Application::$app->response->redirect('');
                }
                else{
                    $error = ['message' => 'Invalid username or password', 'data' => $data];
                    $this->setError($error);
                    Application::$app->response->redirect('login');
                }
                
            }
            // echo "hello";
        }
        else{
            $this->layout = 'auth';
            $this->render('login',['style' => 'login.css', 'title' => "Login"]);
        }
    }

    public function register(){

        if(Application::$app->request->getMethod() == 'POST'){
            $data = Application::$app->request->getBody();
            
            try{
                $userbyemail = User::getUser(array("email"=> $data['email']));
                $userbyname = User::getUser(array("username"=> $data['username']));
            }
            catch(\Exception $e){
                Application::$app->session->setFlash($e->getMessage());
                Application::$app->response->redirect('register');
            }
            if ($userbyname->num_rows > 0) {
                $error = ['message' => 'Username already exists', 'data' => $data];
                $this->setError($error);
                Application::$app->response->redirect('register');   
                exit;
            } 
            else if($userbyemail->num_rows > 0){ 
                $error = ['message' => 'Email already exists', 'data' => $data];
                $this->setError($error);
                Application::$app->response->redirect('register');
                exit;
            }else {
                // create new user 
                $options = [
                    'cost' => 10,
                ];
                // hashing the password 
                $hashed_password = password_hash($data["password"], PASSWORD_BCRYPT, $options);
                $array = array(
                    'username' => $data['username'],
                    'email' => $data["email"],
                    'password' => $hashed_password
                );
                try{
                    User::createUser($array);
                    Application::$app->session->setFlash(["message"=>'User Created Successfully', "type" => "success"]);
                    Application::$app->response->redirect('login');
                }
                catch(\Exception $e){
                Application::$app->session->setFlash($e->getMessage());
                Application::$app->response->redirect('register');
                }
            }
        }
        else{
            $this->layout = 'auth';
            $this->render('register',['style' => 'login.css', "title" => "Register"]);
        }
    }

    public function logout(){
        $this->layout = 'auth';
        Application::$app->session->remove('user');
        Application::$app->session->deleteSession();
        Application::$app->session->setFlash(['message'=>'Logout succesfully', 'type'=>"success"]);
        Application::$app->response->redirect('login');
    }
}