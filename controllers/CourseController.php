<?php

namespace src\controllers;
use src\models\Course;
use src\models\Section;
use src\models\Video;
use src\core\Application;
class CourseController extends Controller{

    public $course;
    public $sections = [];
    public $videos = [];

    public function __construct(){
        if(!Application::$app->isLogin()){
            Application::$app->response->redirect('login');
        }
    }

    public function home(){
        $this->render('home',["style" => 'home.css', "title" => "home"]);
    }

    public function course(){
        $this->render('course');
    }

    public function getCourses(){
        $courses = [];
        $result = Course::getCourses();
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        echo json_encode($courses);
    }

    public function getCourseDetails(){
        $data = Application::$app->request->getBody();
        $result = Course::getCourseById($data['id']);
        $this->course = $result->fetch_assoc();
        $this->getSections($data['id']);
        $this->sendResponse();
    }
    public function getSections($id){
        $result = Section::getSections($id);
        while($row = $result->fetch_assoc()){
            $this->sections[] = $row;
        }
        foreach($this->sections as $section){
            $this->videos[] =  $this->getVideos($section['id']);
        }
    }
    public function getVideos($sectio_id){
        $videoarr = [];
        $result = Video::getVideos($sectio_id);
        while($row = $result->fetch_assoc()){
            $videoarr[] = $row;
        }
        return $videoarr;
    }

    public function sendResponse(){
        echo json_encode(array(
            'status'=> 'success',
            'course'=> $this->course,
            'videos'=> $this->videos,
            "sections"=> $this->sections
        ));
    }


}
