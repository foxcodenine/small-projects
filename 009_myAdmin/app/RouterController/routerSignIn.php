<?php

use app\Model\MyCript;
use app\Model\MyUtilities;
use app\Model\DBConnect;
use app\Model\Mail;
use app\Model\User;



// ___ Sign-In _________________________________________________________
////////////////////////////////////////////////////////////////////////

$router->match('GET|POST', '/sign-in', function() {   

    // --- setting messages
    
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';


    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;'; 


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password  = trim(strip_tags($_POST['password']));  
        $remember  = isset($_POST['remember']) ;

        unset($_POST); 

        $_SESSION['sign-in']['email'] = $email;
        $_SESSION['sign-in']['remember'] = $remember ?? null ;

        // _____________________________________________________________

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';
        } 
        
        if (!$password) {
            $_SESSION['error']['errorPassword'] = 'This field is required';
        }
        


        if ($email && $password) {

            if ($email_in_db = MyUtilities::emailInDB($email)) {
                
                $currentUser      = User::getUserById_Email (null, $email);
                $pass_is_correct  = MyCript::passVerify($currentUser->getPassHash(), $password);
                $user_activated   = $currentUser->getAccountState() === 'Activated';
                $first_time_login = !(bool) $currentUser->getLastLogin();

            }



            if (!$email_in_db || !$pass_is_correct) {
                $_SESSION['message']['content'] = "Your email and password do not match.  Please try again.";
                $_SESSION['message']['type'] = 'danger';

            }  else if (!$user_activated) {
                $_SESSION['message']['content'] = "<span>You Haven't Activated Your Account Yet. 
                Kindly check your mail. <a class='sign__resend-link myLoaderBtn' href='{$_ENV['BASE_PATH']}/resend-email'>Resend email</a></span>";
                $_SESSION['message']['type'] = 'warning';
                $_SESSION['resend-email'] = $email;               
                          

            } else {

                if ($first_time_login) {

                    // var_dump($currentUser); exit();

                    MyUtilities::setUserInSession($currentUser);


                    $_SESSION['remember'] = $remember;
                    

                    header('Location: ' . $_ENV['BASE_PATH'] . '/disclaimer');
                    exit();
       
                } else {

                    $currentUser->setLastLogin(date(DBConnect::DT_FORMAT, time()));
                    $currentUser->updateUser();

                    MyUtilities::setUserInSession($currentUser);                    
                    MyUtilities::setCookie($currentUser, $remember);
                    MyUtilities::checkCookieAndReturnUser();
                }

                // _____________________________________________________

                session_regenerate_id();
                session_write_close(); 
                       
                MyUtilities::redirect($_ENV['BASE_PATH']);
                exit();
            }
        }

        // _____________________________________________________________

        session_write_close();        
        header('Location: ' . $_ENV['BASE_PATH'] . '/sign-in');
        exit();
    }

    $pageName = 'sign_in'; include './app/views/_page.php';

    unset($_SESSION['sign-in']);
    unset($_SESSION['message']);
    unset($_SESSION['error']);

    exit();
});



