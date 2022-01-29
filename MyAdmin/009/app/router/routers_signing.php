<?php
use app\Model\DBConnect;


$router->match('GET|POST', '/sign-up', function() {


    // --- setting messages
    $message = $_SESSION['message']['content'] ?? '&nbsp;';    
    $messageType = $_SESSION['message']['type'] ?? 'none';
    unset($_SESSION['message']);

    

    // --- setting password & error message
    $errorEmail    = $_SESSION['error']['errorEmail'] ?? '&nbsp;';
    $errorPassword = $_SESSION['error']['errorPassword'] ?? '&nbsp;';
    unset($_SESSION['error']);
    
    // --- if post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        unset($_SESSION['message']); unset($_SESSION['error']);

        $firstname = filter_input(INPUT_POST, 'firstname',  FILTER_SANITIZE_STRING);
        $lastname  = filter_input(INPUT_POST, 'lastname',   FILTER_SANITIZE_STRING);
        $email     = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $password  = filter_input(INPUT_POST, 'password',   FILTER_SANITIZE_STRING);       

        

        if (!$email) {
            $_SESSION['error']['errorEmail'] = 'This field is required';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['errorEmail'] = 'Invalid email address';

        } else {
            unset($_SESSION['error']['errorEmail']);
        }

        if (!$password) {
            $_SESSION['error']['errorPassword'] = 'This field is required';

        } elseif (strlen($password) < 6) {
            $_SESSION['error']['errorPassword'] = 'Password is too short';

        } elseif (strlen($password) > 25) {
            $_SESSION['error']['errorPassword'] = 'Password is too long';

        } else {
            unset($_SESSION['error']['errorPassword']);
        }

        if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {            
            $_SESSION['message']['content'] = 'An email has been sent to your email address to activate your account.';
            $_SESSION['message']['type'] = 'success';

            try {

                $conn = DBConnect::getConn();

                $sql = " INSERT INTO User (email, pass,  accountState, roleGroup, signUpDate, firstUserName, lastUserName)
                        VALUES (:email, :pass, :accountState, :roleGroup, :signUpDate, :firstUserName, :lastUserName)";

                $addUser = $conn -> prepare($sql);

                $addUser -> bindValue(':email', $email);
                $addUser -> bindValue(':pass', $password);
                $addUser -> bindValue(':accountState', 'not-validated');
                $addUser -> bindValue(':roleGroup', 'Demo');
                $addUser -> bindValue(':signUpDate', date(DBConnect::DT_FORMAT, time()));
                $addUser -> bindValue(':firstUserName', $firstname);
                $addUser -> bindValue(':lastUserName', $lastname);

                $addUser -> execute();


            } catch (PDOException $e) {
                die("Error getConn: <br>" . $e->getMessage());
            }
        }
        session_write_close();
        
        header('Location: ' . '/009/sign-up');
        exit();
    }

    include './app/views/sign/sign_up.php';    


    exit;
});
