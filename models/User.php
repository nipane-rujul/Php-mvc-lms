<?php

namespace src\models;
use src\core\Application;
class User{
    public static function getUser($query){
        return Application::$app->db->getRecord("USER",$query);
    }

    // function to create new user
    public static function createUser($data){
        Application::$app->db->insertRecord("USER", $data);
    }

    public static function Login($row, $password){
        if (password_verify($password, $row["password"])) {
            Application::$app->session->set('user', ['username' => $row['username'], 'userId' => $row['id'], 'isAdmin' => $row['isAdmin']]);
            // $_SESSION['username'] = $row['username'];
            // $_SESSION['userId'] = $row['id'];
            // if ($row['isAdmin'] === "yes") {
            //     $_SESSION['isAdmin'] = true;
            // } else {
            //     $_SESSION['isAdmin'] = false;
            // }
            return true;
        }
        return false;
    }

}