<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: white;
            transition: width .3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    <title>Hikes</title>
</head>
<?php
ob_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
//correction des caracteres speciaux
header('Content-Type: text/html; charset=utf-8');
//path to the project's root folder (for all the links)
define('BASE_PATH', 'https://www.imadeus.be/others/hiking-project');
// en localhost
// define('BASE_PATH', 'http://localhost/hiking-project');
require_once __DIR__ . '/vendor/autoload.php';
require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/user/user.php');
require_once('src/controllers/user/logout.php');
require_once('src/controllers/hikes/hikesdetails.php');
require_once('src/controllers/hikes/hikescomments.php');
require_once('src/controllers/hikes/hikesusermngt.php');

$envFilePath = '.env';
$env = parse_ini_file($envFilePath);

use Application\Controllers\{
    Header,
    Homepage,
    Footer,
    User\User,
    User\Logout,
    Hikes\HikesDetails,
    Hikes\HikesComments,
    Hikes\HikesUserMngt
};

$router = new AltoRouter();
$router->setBasePath('/others/hiking-project');
// en localhost
// $router->setBasePath('/hiking-project');

$router->map('GET', '/', function () use ($env) {
    (new Homepage())->execute($env);
});

$router->map('GET', '/login', function () {
    (new User())->login('');
});

//check if methd POST
$router->map('POST', '/login/verification', function () use ($env) {
    (new User())->login($env);
});

//check if methd POST
$router->map('POST', '/sub/verification', function () use ($env) {
    (new User())->register($env);
});

$router->map('GET', '/register', function () {
    (new User())->register('');
});

$router->map('GET', '/logout', function () {
    (new Logout())->execute();
});

$router->map('GET', '/hikes/[i:hikesId]', function ($hikesId) use ($env) {
    (new HikesDetails())->ShowHikes($hikesId, $env);
});

$router->map('POST', '/hikes/addcomment/[i:hikeid]/[i:userid]', function ($hikeid, $userid) use ($env) {
    (new HikesComments())->AddComment($_POST, $hikeid, $userid, $env);
});

$router->map('GET', '/hikes/deletecom/[i:hikeid]/[i:commentid]', function ($hikeid, $commentid) use ($env) {
    (new HikesComments())->DeleteComment($hikeid, $commentid, $env);
});

$router->map('GET', '/hikes/editcom/[i:hikeid]/[i:commentid]', function ($hikeid, $commentid) use ($env) {
    (new HikesComments())->EditComment($hikeid, $commentid, [], 'editCommentHicke', $env);
});

$router->map('POST', '/hikes/editcom/[i:hikeid]/[i:commentid]', function ($hikeid, $commentid) use ($env) {
    (new HikesComments())->EditComment($hikeid, $commentid, $_POST, 'editCommentHickeV', $env);
});

$router->map('GET', '/user/showprofil/[i:userid]', function ($userid) use ($env) {
    (new User())->ShowProfil($userid, $env, '');
});

$router->map('POST', '/user/showprofil/[i:userid]', function ($userid) use ($env) {
    (new User())->ShowProfil($userid, $env, 'editprofil');
});

$router->map('POST', '/user/saveprofil/[i:userid]', function ($userid) use ($env) {
    (new User())->SaveProfil($userid, $_POST, $env, 'saveprofil');
});

$router->map('POST', '/user/deleteprofil/[i:userid]', function ($userid) use ($env) {
    (new User())->SaveProfil($userid, '', $env, 'deleteprofil');
});

$router->map('GET', '/user/hikesmngt/[i:userid]', function ($userid) use ($env) {
    (new Hikesusermngt())->ListHikesUser($userid, $env);
});

$router->map('GET', '/category/[:tagsid]', function ($tagsid) use ($env) {
    (new Homepage())->ShowSelectedTags($tagsid, $env);
});


$router->map('GET', '/user/hikesmngt/edit/[i:hikeid]', function ($hikeid) use ($env) {
    (new Hikesusermngt())->EditHikesUser($hikeid, $env, '', '');
});

$router->map('POST', '/user/hikesmngt/edit/save/[i:hikeid]/[i:userid]', function ($hikeid, $userid) use ($env) {
    (new Hikesusermngt())->SaveHikesUser($hikeid, $env, $_POST, $userid, 'edithike');
});

$router->map('POST', '/user/hikesmngt/add/[i:userid]', function ($userid) use ($env) {
    (new Hikesusermngt())->AddHikesUser($userid, $env);
});

$router->map('POST', '/user/hikesmngt/add/save/[i:userid]', function ($userid) use ($env) {
    (new Hikesusermngt())->SaveHikesUser('', $env, $_POST, $userid, 'saveaddhike');
});

$router->map('GET', '/user/hikesmngt/delete/[i:hikeid]', function ($hikeid) use ($env) {
    (new HikesDetails())->DeleteHike($hikeid, $env);
});


//Route matching
$match = $router->match();

if (is_array($match) && is_callable($match['target'])) {
    (new Header())->execute($env);
    call_user_func_array($match['target'], $match['params']);
    (new Footer())->execute();
} else {
    //Page 404
    require(__DIR__ . '/src/view/404.view.php');
}
ob_end_flush();
