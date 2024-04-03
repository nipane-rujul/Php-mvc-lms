<?php

namespace src\models;
use src\core\Application;
class Video{
    public static function createVideo($title,$video_url,$section_id){
        $id = Application::$app->db->insertRecord("VIDEO",array(
            "section_id"=> $section_id,
            "video_url" => $video_url,
            "title" => $title
        ));
        return $id;
    }

    // function to get all videos of particular section
    public static function getVideos($sectionid){
        return Application::$app->db->getRecord("VIDEO",array("section_id" =>$sectionid));
    }

    // function to get particular video
    public static function getVideo($videoid,$sectionid){
        return Application::$app->db->getRecord("VIDEO",array('id' => $videoid,'section_id'=> $sectionid));
    }

    // function to delete video
    public static function deleteVideo($videoid,$sectionid){
         Application::$app->db->deleteRecord('VIDEO',array('id' => $videoid,'section_id'=> $sectionid));
    }
}