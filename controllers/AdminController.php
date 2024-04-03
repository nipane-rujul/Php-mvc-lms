<?php

namespace src\controllers;

use src\core\Application;
use src\models\File;
use src\models\Course;
use src\models\Section;
use src\models\Video;

class AdminController extends Controller
{
    public $sectionUrl;
    public function __construct()
    {
        if (!Application::$app->isAdmin()) {
            Application::$app->response->redirect('_505');
        }
    }
    public function CreateCourse()
    {

        if (Application::$app->request->getMethod() == 'POST') {
            $data = Application::$app->request->getBody();
            $target_dir = "/uploads/Courses/";
            $targetfile = File::encrypt($data['courseTitle']);
            $target_dir .= $targetfile . "/";

            // create course directory 
            try {
                File::createDir($_SERVER['DOCUMENT_ROOT'] . $target_dir);
            } catch (\Exception $e) {
                $_SESSION["error"] = $e->getMessage();
                exit;
            }
            // creating default section 
            $targetsection = File::encrypt("default");
            $sectiondir = $target_dir . $targetsection . "/";
            try {
                File::createDir($_SERVER['DOCUMENT_ROOT'] . $sectiondir);
                $this->sectionUrl = $sectiondir;
            } catch (\Exception $e) {
                exit;
            }
            try {
                echo "here";
                $id = Course::createCourse(array(
                    $data['courseTitle'],
                    $data['courseDes'],
                    $target_dir
                ));
                Section::createSection($id, "Section 1", $this->sectionUrl);
                Application::$app->response->redirect('course');
            } catch (\Exception $e) {
                $_SESSION["error"] = $e->getMessage();
                echo $e->getMessage();
            }
        } else {

            $this->render('CreateCourse');
        }
    }
    public function addSection()
    {
        $data = Application::$app->request->getBody();
        // echo json_encode($data);

        $targetfile = File::encrypt($data['title']);
        // get course of section
        try {
            $result = Course::getCourseByID($data['id']);
            $course = $result->fetch_assoc();
        } catch (\Exception $e) {
            json_encode(array('error' => $e->getMessage()));
        }

        $title = $course['url'];
        $target_dir = "$title/" . $targetfile . "/";
        //    creating section directory 

        try {
            File::createDir($_SERVER['DOCUMENT_ROOT'] . $target_dir);
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
            exit;
        }
        // saving section in Database
        try {
            $id = Section::createSection($data["id"], $data["title"], $target_dir);
            echo json_encode(array("status" => "success", "message" => "Section Created", "id" => $id));
        } catch (\Exception $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
    }

    public function editCourse()
    {
        echo json_encode("add");
    }

    public function addVideo()
    {

        $data = Application::$app->request->getBody();
        try {
            $result = Section::getSection($data['sectionId'], $data['courseId']);
            $section = $result->fetch_assoc();
            // echo json_encode($section);
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
        $target_dir = $section['section_url'];
        if (isset($_FILES["videoFile"])) {
            $videoname = basename($_FILES['videoFile']['name']);
            $extension = pathinfo($videoname, PATHINFO_EXTENSION);
            $videoname = strtolower(str_replace(' ', '', basename($_FILES['videoFile']['name'])));
            $current_date_time = date('YmdHis');
            $filename = $videoname . $current_date_time;
            $hashedcode = hash('sha1', $filename);
            $file = substr($hashedcode, 0, 6);
            $target_file = $target_dir . $file . '.' . $extension;
            try {
                File::uploadFile($_FILES["videoFile"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $target_file);
            } catch (\Exception $e) {
                echo json_encode(array("error" => $e->getMessage()));
                exit;
            }
        }

        // save video details in database 
        try {
            $id = Video::createVideo($data['video-title'], $target_file, $data["sectionId"]);
            echo json_encode(array('title' => $data["video-title"], 'id' => $id, "url" => $target_file));
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    public function deleteCourse()
    {
        try {
            $data = Application::$app->request->getBody();
            $result = Course::getCourseById($data['id']);
            $course = $result->fetch_assoc();
            $title = $course['url'];
            File::deleteDir($_SERVER['DOCUMENT_ROOT'] . $title);
            Course::deleteCourse($data['id']);
            echo json_encode(array("success" => true, "message" => "Deleted Course Successfully"));
        } catch (\Exception $e) {
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        }
    }

    public function deleteSection()
    {
        // delete section Directory  
        $data = Application::$app->request->getBody();
        try {
            $result = Section::getSection($data['section_id'], $data['course_id']);
            $section = $result->fetch_assoc();
            File::deleteDir($_SERVER['DOCUMENT_ROOT'] . $section['section_url']);
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
        // delete section record from table 
        try {
            Section::deleteSection(array("course_id" => $data['course_id'], "section_id" => $data['section_id']));
            echo json_encode(array("success" => true));
        } catch (\Exception $e) {
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    public function deleteVideo()
    {
        
        $data = Application::$app->request->getBody();
        try{
            $result = Video::getVideo($data['video_id'], $data['section_id']);
            $video = $result->fetch_assoc();
            File::deleteFile($_SERVER['DOCUMENT_ROOT'] . $video['video_url']);
            Video::deleteVideo($data["video_id"], $data["section_id"]);
            echo json_encode(array('msg'=>'deleted Video successfully'));
        }
        catch(\Exception $e){
            echo json_encode(array('error'=> $e->getMessage()));
        }
    }

    public function _505()
    {
        $this->render('_505');
    }
}
