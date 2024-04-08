<?php

namespace src\controllers;

class ErrorController extends Controller{
    // access error 
    public function error403()
    {
        $this->layout =  'auth';
       $this->render('_403',['style'=>'404.css','title'=>'Access Error']);
    }

    // not found error 
    public function error404(){
        $this->layout = 'auth';
        $this->render('_404',['style'=>'404.css','title'=>"Not Found"]);
    }
}