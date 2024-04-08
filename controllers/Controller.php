<?php

namespace src\controllers;

use src\core\Session;

use src\core\Application;

class Controller
{

    protected $layout = "main";

    protected function setError($error)
    {
        Application::$app->session->set('error', $error);
    }

    // validating the data 
    public function validate($data)
    {
        $error = [];
        if ($data['username']) {
            $pattern = '/^[a-zA-Z0-9]+$/';
            if (!preg_match($pattern, $data['username'])) {
                $error = ['message' => 'Username should contain only digits and letters', 'data' => $data];
                $this->setError($error);
                return false;
            }
        }
        if ($data['email']) {
            $pattern = '/^\S+@\S+\.\S+$/';
            if (!preg_match($pattern, $data['email'])) {
                $error = ['message' => 'Enter valid email', 'data' => $data];
                $this->setError($error);
                return false; 
            } 
        }
        if ($data['password']) {
            if (strlen($data['password']) < 5) {
                $error = ['message' => 'Password length should be greater than 5', 'data' => $data];
                $this->setError($error);
                return false;
            }
        }
        if(!$data['password'] === $data['cpassword']){
            $error = ['message' => 'Password does not match', 'data' => $data];
            $this->setError($error);
            return false;
        }
        return true;

    }
    protected function render($view, $params = [])
    {
        // rendering the view 
        echo $this->renderView($view, $params);
    }

    public function renderView($view, $params = [])
    {
        // embed content of view into layout 
        $layoutContent = $this->layoutContent($params);
        $error = Application::$app->session->get('error');
        Application::$app->session->remove('error');
        $viewContent = $this->renderOnlyView($view, $params, $error);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    protected function layoutContent($params)
    {
        $layout = $this->layout;
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once "../views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params, $errors = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        foreach ($errors as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once "../views/$view.php";
        return ob_get_clean();
    }
}
