<?php

namespace Application\Controllers\User;

require_once('src/lib/database.php');
require_once('src/model/user.php');
require_once('src/model/login.php');
require_once('src/model/hickescomments.php');


use Application\Model\User as UserModel;
use Application\Model\Login as UserLogin;
use Application\Model\HikesComments as HikesCommentsModel;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

use PDO;

class User
{
    public function login($env)
    {
        $error = '';
        if (isset($_POST['email'], $_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);

            $newData = new UserLogin($env);

            $result = $newData->existEmail($email);
            if ($result && password_verify($password, $result['password'])) {

                // store data of user in $_SESSION
                $_SESSION['user'] = [
                    'sess_id' => $result['id'],
                    'sess_user' => $result['nickname']
                ];

                // Regenerate session ID to mitigate session fixation attacks
                // desactivé sinon la session n est pas prise en compte
                //  session_regenerate_id(true);

                $success_login = "Login Successfull.";
                $success_welcome = "Welcome " . htmlspecialchars($result['nickname']);
            } else {
                $error = "Invalid email or password. Retry.";
            }
        } else {
            $error = "No data received";
        }
        require(__DIR__ . '/../../view/user/login.view.php');
    }

    public function register($env)
    {
        $error = '';
        if (isset($_POST['nickname'], $_POST['email'], $_POST['password'])) {
            $nickname = htmlspecialchars($_POST['nickname']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = htmlspecialchars($_POST['password']);
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);

            $newData = new UserModel($env);

            if (!$newData->isValidEmail($email)) {
                $error = "The entered email address is not valid.";
            } else {
                // check if nickname is already in the database
                $nickname_verif = $newData->checkDuplicateUser($nickname);
                if ($nickname_verif > 0) {
                    $error = "User already exists. Please, choose another login !";
                } else {
                    // check if email is already in the database
                    $email_verif = $newData->checkDuplicateMail($email);
                    if ($email_verif > 0) {
                        $error = "Email already exists. Please, choose another mail or retrieve your informations!";
                    } else {

                        $userCount = $newData->firstUser();
                        $user_admin = ($userCount == 0) ? 1 : 0;
                        $id = $newData->addUser($nickname, $email, $password_crypt, $user_admin);
                        //Autologin after subscription

                        $_SESSION['user'] = [
                            'sess_id' => $id,
                            'sess_user' => $nickname
                        ];
                        // Send email after successful registration
                        // $phpmailer = new PHPMailer(true);
                        // $phpmailer->SMTPDebug = 0;
                        // $phpmailer->isSMTP();
                        // $phpmailer->Host = 'smtp-pulse.com'; // Replace with your SMTP server
                        // $phpmailer->SMTPAuth = true;
                        // $phpmailer->Port = 587; // Replace with your port
                        // $phpmailer->Username = $env['mailer_user']; // Replace with your login
                        // $phpmailer->Password = $env['mailer_pwd']; // Replace with your password
                        // $phpmailer->setFrom('eno@enkelan.tech', 'Eno&Damien Domain'); // Replace with your email and name
                        // $phpmailer->addAddress($email, $nickname);     // Add a recipient
                        // $phpmailer->isHTML(true);                      // Set email format to HTML
                        // $phpmailer->Subject = 'Welcome to our website!';
                        // $phpmailer->Body = '
// echo '
// <div style="background-color: #edf2f7; padding: 20px;">
//     <div style="max-width: 600px; margin: auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);">
//         <h2 style="color: #2d3748; margin-bottom: 20px;">Welcome to our website!</h2>
//         <p style="color: #4a5568; line-height: 1.6;">Dear ' . $nickname . ',</p>
//         <p style="color: #4a5568; line-height: 1.6;">Thank you for registering on our website. We are excited to have you on board.</p>
//         <p style="color: #4a5568; line-height: 1.6;">If you have any questions, feel free to reply to this email. We\'re here to help!</p>
//         <p style="color: #4a5568; line-height: 1.6;">Best regards,</p>
//         <p style="color: #4a5568; line-height: 1.6;"><b>Eno&Damien</b></p>
//     </div>
// </div>
// ';
                        // $phpmailer->AltBody = 'Welcome to our website! Dear ' . $nickname . ', Thank you for registering on our website. We are excited to have you on board. If you have any questions, feel free to reply to this email. We\'re here to help! Best regards, Your Team';
                        // $phpmailer->send();
                    }
                }
            }
        } else {
            $error = "No data received";
        }
        require(__DIR__ . '/../../view/user/register.view.php');
    }

    public function ShowProfil($userid, $env, $action)
    {
        $newData = new UserModel($env);

        $user_infos = $newData->getUserInfos($userid);
        $user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
        $user_admin = $newData->getUserAdminStatus($user_id);

        $all_Userinfos = $newData->getAllUserInfos();
        require(__DIR__ . '/../../view/user/showprofil.view.php');
    }

    public function SaveProfil($userid, $input, $env, $action)
    {
        $newData = new UserModel($env);

        if ($action == 'deleteprofil') {
            $newData->DeleteUser($userid);

            $newData = new HikesCommentsModel($env);
            $newData->DelAllCommentHicke($userid);

            session_destroy();
            echo "<script>window.location.href='" . BASE_PATH . "'</script>";
            exit();
        }

        $firstname = htmlspecialchars($input['firstname']);
        $lastname = htmlspecialchars($input['lastname']);
        $nickname = htmlspecialchars($input['nickname']);
        $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $radio_UserAdmin = htmlspecialchars($input['user_admin']);

        $user_id = isset($_SESSION['user']['sess_id']) ? $_SESSION['user']['sess_id'] : null;
        $user_admin = $newData->getUserAdminStatus($user_id);
        $newData->SaveUserInfos($userid, $firstname, $lastname, $nickname, $email, $radio_UserAdmin);

        if ($action == 'saveprofil') {
            $user_infos = $newData->getUserInfos($userid);
            $successMessage = "Profile edited successfully.";
        }


        require(__DIR__ . '/../../view/user/showprofil.view.php');
    }
}
