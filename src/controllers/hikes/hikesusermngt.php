<?php

namespace Application\Controllers\Hikes;

require_once('src/model/hickeslist.php');
require_once('src/model/tags.php');
require_once('src/model/user.php');

use Application\Model\Hickeslist\Hickeslist;
use Application\Model\Tags as TagsModel;
use Application\Model\User as UserModel;


class Hikesusermngt
{
    public function ListHikesUser($userid, $env)
    {
        $newData = new Hickeslist($env);
        $hikes = $newData->getHikesListUser();

        //we check if the user connected is an admin, if yes, he will be able to edit and delete comments (see hikesdetails.view.php) condition || ($user_admin == "1")
        $newData = new UserModel($env);
        $user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
        $user_admin = $newData->getUserAdminStatus($user_id);
        
        require(__DIR__ . '/../../view/hikes/hikesusermngt.view.php');
    }

    public function EditHikesUser($hikeid, $env, $action)
    {
        $newData = new Hickeslist($env);
        $tags = new TagsModel($env);
        
        $tagList = $tags->getTags();
        $hikes = $newData->EditHikes($hikeid);
        require(__DIR__ . '/../../view/hikes/hikesusermngtedit.view.php');

        //elseif ($action=='deletehike') {
        //$hikes = $newData->DeleteHikes($hikeid);
        //}
    }

    public function SaveHikesUser($hikeid, $env, $input, $userid, $action)
    {
        $newData = new Hickeslist($env);
        
        $name = htmlspecialchars($input['name']);
        $distance = htmlspecialchars($input['distance']);
        $duration = htmlspecialchars($input['duration']);
        $elevation_gain = htmlspecialchars($input['elevation_gain']);
        $description = htmlspecialchars($input['description']);
        date_default_timezone_set('Europe/Paris');
        $date_update = new \DateTime();
        $updated_at = $date_update->format("Y-m-d H:i:s");
        $id_tag = htmlspecialchars($input['id_tags']);

        if ($action == 'edithike') {
            $message = $newData->SaveHikes($hikeid, $name, $distance, $duration, $elevation_gain, $description, $updated_at, $id_tag);
            echo "<script>window.location.href='" . BASE_PATH . "/user/hikesmngt/" . $userid . "?message=" . urlencode($message) . "'</script>";
        } 
        elseif ($action == 'saveaddhike') {
            $created_by = htmlspecialchars($userid);
            $created_at = $date_update->format("Y-m-d H:i:s");
            $message = $newData->SaveAddHikes($name, $distance, $duration, $elevation_gain, $description, $created_by, $created_at, $updated_at, $id_tag);
            echo "<script>window.location.href='" . BASE_PATH . "/user/hikesmngt/" . $userid . "?message=" . urlencode($message) . "'</script>";
        }
    }

    public function AddHikesUser($userid, $env)
    {
        //we set the databaseConnection for the __construct method
        $tags = new TagsModel($env);

        $tagList = $tags->getTags();
        require(__DIR__ . '/../../view/hikes/hikesusermngtadd.view.php');
    }
}
