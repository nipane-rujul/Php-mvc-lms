<?php

namespace src\models;

use src\core\Application;

class Course{
    public static function getCourses()
    {
        return Application::$app->db->getRecords("COURSE");
    }

    // function to get particular course by course id 
    public static function getCourseById($courseId)
    {
        return Application::$app->db->getRecord("COURSE", array(
            "id" => $courseId
        ));
    }

    // function to create course 
    public static function createCourse($data)
    {
        $id = Application::$app->db->insertRecord("COURSE", array(
            "title" => $data[0],
            "details" => $data[1],
            "url" => $data[2],
        ));
        return $id;
    }   
    
    // function to update course
    public static function updateCourse($data){
        Application::$app->db->updateRecord("COURSE",array(
            "title"=> $data["title"],
            "details" => $data["details"],
            // "url" => $data["url"],
        ),
        array("id"=> $data["id"]));
    }

    // function to delete particular course
    public static function deleteCourse($courseId){
        Application::$app->db->deleteRecord("COURSE", array("id" => $courseId));
    }
}