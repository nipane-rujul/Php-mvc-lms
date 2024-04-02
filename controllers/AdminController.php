<?php
namespace src\controllers;

use src\core\Application;
use src\models\File;
use src\models\Course;
use src\models\Section;
class AdminController extends Controller{
    public $sectionUrl;

    public function CreateCourse(){

        if(Application::$app->request->getMethod() == 'POST'){
            $data = Application::$app->request->getBody();

            $target_dir = "/uploads/Courses/";
            $targetfile = File::encrypt($data['courseTitle']); 
            $target_dir .= $targetfile . "/";

        // create course directory 
        try{
            File::createDir($_SERVER['DOCUMENT_ROOT'] . $target_dir);
        }
        catch( \Exception $e)    {
            // header('Location: ' . "../views/createCourse.php");
            $_SESSION["error"] = $e->getMessage();
            exit;
        }
       

        // creating default section 
        $targetsection = File::encrypt("default");
        $sectiondir = $target_dir . $targetsection . "/";
        try{
            File::createDir( $_SERVER['DOCUMENT_ROOT'] . $sectiondir);
            $this->sectionUrl = $sectiondir;
        }
        catch(\Exception $e)    {
            
            exit;
        }
        
            try {
                $id = Course::createCourse(array(
                    $data['courseTitle'],
                    $data['courseDes'],
                ));
                Section::createSection($id,"Section 1", $this->sectionUrl);
                echo "here";
                // $_SESSION["success"] = "New Course Created successfully";
                // header('Location: ' . "../views/Course.php?id=$id");
                Application::$app->response->redirect('course');
            } catch (\Exception $e) {
                $_SESSION["error"] = $e->getMessage();
            }
        }
        else{
            $this->render('CreateCourse');
        }
    }
}