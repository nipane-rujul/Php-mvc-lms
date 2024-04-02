<?php

namespace src\controllers;
use src\models\Course;

class CourseController extends Controller{
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

}
