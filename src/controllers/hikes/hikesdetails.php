<?php

namespace Application\Controllers\Hikes;

require_once('src/lib/database.php');
require_once('src/model/hickeslist.php');
require_once('src/model/user.php');

use Application\Model\User as UserModel;
use Application\Model\Hickeslist\Hickeslist;

class HikesDetails
{
    //Give the Id information URL if we want to display the details of a product
    public function ShowHikes($hikesId, $env)
    {
        $error_com = '';
        $success_com = '';

        //we set the databaseConnection for the __construct method
        $HickesDetails = new Hickeslist($env);

        $hike = $HickesDetails->getHikesDetails($hikesId);
        $hikesComments_array = $HickesDetails->getHikesComments($hikesId);

        //we check if the user connected is an admin, if yes, he will be able to edit and delete comments (see hikesdetails.view.php) condition || ($user_admin == "1")
        $newData = new UserModel($env);
        $user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
        $user_admin = $newData->getUserAdminStatus($user_id);

        //$productComments = $HickesDetails->getProductComments($codeProduct);
        require(__DIR__ . '/../../view/hikes/hikesdetails.view.php');
    }
    public function DeleteHike($hikesId, $env)
    {
        //we set the databaseConnection for the __construct method
        $HickesDetails = new Hickeslist($env);

        $message = $HickesDetails->deleteHike($hikesId);

        $user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
    
        header('Location: ' . BASE_PATH . '/user/hikesmngt/' . $user_id . '?message=' . urlencode($message));
        exit();
    }
}
