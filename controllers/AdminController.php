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
            echo "here";
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
                    $target_dir
                ));
                Section::createSection($id,"Section 1", $this->sectionUrl);
                Application::$app->response->redirect('course');
            } catch (\Exception $e) {
                $_SESSION["error"] = $e->getMessage();
            }
        }
        else{
            $this->render('CreateCourse');
        }
    }

    public function addSection(){
        $data = Application::$app->request->getBody();
        // echo json_encode($data);
        
        $targetfile = File::encrypt($data['title']);
        // get course of section
        try{
            $result = Course::getCourseByID($data['id']);
            $course = $result->fetch_assoc();
        }
       catch (\Exception $e) {
        json_encode(array('error'=> $e->getMessage()));
       }
       
        $title = $course['url'];
        $target_dir ="$title/" . $targetfile . "/";
        // echo json_encode($target_dir);
    //    creating section directory 
    
        try{
            File::createDir($_SERVER['DOCUMENT_ROOT'] . $target_dir);
        }
        catch( \Exception $e)    {
            echo json_encode(array("error"=> $e->getMessage()));
            exit;
        }
        // saving section in Database
        try{
            $id = Section::createSection($data["id"],$data["title"], $target_dir);
            echo json_encode(array("status"=> "success","message"=> "Section Created", "id" => $id));
        }
        catch(\Exception $e) {
            echo json_encode(array('error'=> $e->getMessage()));
        }
    }

    public function addVideo(){
        json_encode("add");
    }

    public function editCourse(){
        echo "ho";
    }
    public function deleteCourse(){
        try {
            $data = Application::$app->request->getBody();
            $result = Course::getCourseById($data['id']);
            $course = $result->fetch_assoc();
            $title = $course['url'];
            echo json_encode($title);
            File::deleteDir($_SERVER['DOCUMENT_ROOT'] . $title);
            Course::deleteCourse($data['id']);
            // echo json_encode(array("success" => true, "message" => "Deleted Course Successfully"));
        } catch (\Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
    }
    
    public function deleteSection(){
        echo "ho";
    }
    public function deleteVideo(){
        echo "ho";
    }
}