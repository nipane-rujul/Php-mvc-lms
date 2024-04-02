<?php

namespace src\controllers;
use src\core\Application;
use src\models\User;

class AuthController extends Controller{

    public function home(){
        $this->render('home',["style" => 'home.css', "title" => "home"]);
    }
    public function login(){

        if(Application::$app->request->getMethod() == 'POST'){
            $data = Application::$app->request->getBody();
            // var_dump($data);
            try{
                $user = User::getUser(array("username"=> $data["username"]));
            }
            catch(\Exception $e){
                
                // $_SESSION['error'] = $e->getMessage();
                exit;
            }
            
            if($user->num_rows == 0){
                $this->render('login',["error" => "Invalid username or password"]);
                exit;
            }
            else{
                // login the user by verifying password
                $row = $user->fetch_assoc();
                if(User::Login($row,$data["password"])){
                    $this->render('home');
                }
                else{
                    $this->render('login',['style' => 'login.css', 'title' => "Login"],["error" => "Invalid username or password"]);
                }
                
            }
            // echo "hello";
        }
        else{
            $this->render('login',['style' => 'login.css', 'title' => "Login"]);
        }
    }

    public function register(){

        if(Application::$app->request->getMethod() == 'POST'){
            $data = Application::$app->request->getBody();
            // var_dump($data);
            try{
                $userbyemail = User::getUser(array("email"=> $data['email']));
            }
            catch(\Exception $e){
                // header('Location: '. "../views/Login.php");
                // $_SESSION['error'] = $e->getMessage();
            }
            try{
                $userbyname = User::getUser(array("username"=> $data['username']));
            }
            catch(\Exception $e){
                // header('Location: '. "../views/Login.php");
                $_SESSION['error'] = $e->getMessage();
            }
            if ($userbyname->num_rows > 0) {
                // $_SESSION['error'] = "Username already exists";
                // $_SESSION['details'] = array('username'=> $this->username, 'email' => $this->email);
                $this->render('register',['style'=>'login.css', 'title' => 'Register']);
                // header('Location: '. "../views/Registration.php");
                exit;
            } 
            else if($userbyemail->num_rows > 0){
                // $_SESSION['error'] = "Email already exists";
                $this->render('register',['style'=>'login.css', 'title' => 'Register']);
                // $_SESSION['details'] = array('username'=> $this->username, 'email' => $this->email);
                // $this->render('register',['style'=>'login.css', 'title' => 'Register']);
                // header('Location: '. "../views/Registration.php");
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
                    // $_SESSION['success'] = "User Created Successfully.";
                    // header('Location: ' . "../views/Login.php");
                    $this->render('login');
                }
                catch(\Exception $e){
                    $_SESSION['error'] = $e->getMessage();
                    // header('Location: '. "../views/Login.php");
                }
            }
        }
        else{
            $this->render('register',['style' => 'login.css', "title" => "Register"]);
        }
    }
}