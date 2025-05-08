<?php

namespace Application\Controllers;

require_once('src/lib/database.php');
require_once('src/model/tags.php');

use Application\Model\Tags as TagsModel;
// Set session cookie attributes for security
session_set_cookie_params([
    'lifetime' => 3600, // Adjust session lifetime as needed
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true, // Send cookie over HTTPS only
    'httponly' => true // Prevent JavaScript access to cookie
]);

session_start();

//test de l existence d une session
$user_identifiant = isset($_SESSION['user']['sess_user']) ? $_SESSION['user']['sess_user'] : null;
$user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;

class Header
{

    public function execute($env)
    {
        //we set the databaseConnection for the __construct method
        $tags = new TagsModel($env);

        $tagList = $tags->getTags();

        require(__DIR__ . '/../view/header.view.php');
    }
}
