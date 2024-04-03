<?php
namespace src\models;
use src\core\Application;
class Section{
    public static function getSections($courseid){
        return Application::$app->db->getRecord("SECTION",array(
            "course_id" => $courseid
        ));
    }

    // function to get particular section
    public static function getSection($section_id, $course_id){
        return Application::$app->db->getRecord("SECTION",array("id" => $section_id,"course_id"=> $course_id));
    }

    // function to create section
    public static function createSection($courseid, $data, $section_url){
        $id = Application::$app->db->insertRecord("SECTION",array(
            "course_id"=> $courseid,
            "title"=> $data,
            "section_url" => $section_url
        ));
        return $id;
    }

    // function to delete section
    public static function deleteSection($data){
        Application::$app->db->deleteRecord("SECTION",array(
            "id" => $data["section_id"],
            "course_id" => $data["course_id"],
        ));
    }

}