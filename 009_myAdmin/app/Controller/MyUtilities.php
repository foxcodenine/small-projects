<?php

namespace app\Controller;

use app\Model\DBConnect;
use app\Model\User;
use PDO;

class MyUtilities {

    public static function emailInDB($email) {   
        /** Check if email is alreay in database */  

        $sql = 'SELECT COUNT(email) AS "count" FROM User WHERE email = :email GROUP BY email';

        $conn = DBConnect::getConn();

        $stmt = $conn -> prepare($sql);

        $stmt -> bindValue(':email', $email);

        $stmt -> execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return (bool) $result;     
    }

    // _________________________________________________________________

    public static function whoami () {

        if ($_ENV['APP_ENV'] === 'production' && $_SERVER['SERVER_NAME'] === 'foxcode.io') {
            return 'productionServer';
        }

        if ($_ENV['APP_ENV'] === 'development' && gethostname() === 'Inspiron16' && php_uname('s') === 'Linux') {
            return 'develepmentHome';
        }
    }

    // _________________________________________________________________

    public static function runBackgroundProsess($command, $outputFile = '/dev/null') {
        $processId = shell_exec(sprintf('%s > %s 2>&1 & echo $!', $command, $outputFile ));  
        return $processId;
    }

    // _________________________________________________________________

    public static function currentUserInSession() {
        if (isset($_SESSION['currentUser'])) {

            session_write_close();        
            header('Location: ' . '/009');
            exit();
        }
    }

    // _________________________________________________________________

    public static function currentUserNotInSession() {
        if (isset($_SESSION['currentUser'])) {
            
            session_write_close();        
            header('Location: ' . '/009/sign-in');
            exit();
        }
    }

    // _________________________________________________________________

    public static function setCookie($currentUser, $remember=false) {

        $token  = MyCript::generateKey();

        // --- Updating DB -------------

        $currentUser->setToken($token);
        $currentUser->updateUser();   
        
        // --- Updating Cookie ---------
        
        $cookieName   = 'FOXCODE_IO|009|MYADMIN'; 
        $cookieValue = json_encode([$currentUser->getId(), $token]);                    
        $cookieExp    =  isset($remember) ? (time() + ($_ENV['COOKIE_EXP'])) : 0;
        $cookiePath   = $_ENV['COOKIE_PATH'];
        $cookieDomain = $_ENV['COOKIE_DOMAIN'];
        
        setcookie($cookieName, $cookieValue, $cookieExp, $cookiePath, $cookieDomain);

        // --- Updating Session ---------

        $_SESSION['currentUser'] = serialize($currentUser);

        return $currentUser;        
    }

    // _________________________________________________________________

    public static function unsetCookie($currentUser) {

        // --- Updating DB -------------

        $currentUser->setToken('');
        $currentUser->updateUser();  

        // --- Updating Cookie ---------

        $cookieName   = 'FOXCODE_IO|009|MYADMIN'; 
        $cookieValue = json_encode([$currentUser->getId(), null]);                    
        $cookieExp    =  time() - 3600;
        $cookiePath   = $_ENV['COOKIE_PATH'];
        $cookieDomain = $_ENV['COOKIE_DOMAIN'];

        setcookie($cookieName, $cookieValue, $cookieExp, $cookiePath, $cookieDomain);

        // --- Updating Session ---------

        unset($_SESSION['currentUser']);

        return false;
    }

    // _________________________________________________________________


    public static function checkCookieAndReturnUser() {

        // --- fetch cookie ---------------------

        $cookieData = $_COOKIE['FOXCODE_IO|009|MYADMIN'] ?? false;

        // --- fetch user from database ---------

        if ($cookieData) {            
            $userId = filter_var(json_decode($cookieData)[0], FILTER_SANITIZE_STRING);
            $userToken = filter_var(json_decode($cookieData)[1], FILTER_SANITIZE_STRING);

            $currentUser = User::getUserById_Email($userId) ?? null;   
        }

        // --- Compare database with cookie ------


        if (isset($currentUser) && !empty($currentUser) && $currentUser->getToken() === $userToken) {
            $_SESSION['currentUser'] = serialize($currentUser);
            return $currentUser;
        } 

        unset ($_SESSION['currentUser']);
        return false;
    }

    // _________________________________________________________________

    public static function setUserInSession($currentUser=false) {

        if (!isset($currentUser) || !$currentUser) {
            unset($_SESSION['currentUser']);
            return false;
        }

        $_SESSION['currentUser'] = serialize($currentUser);
        return $currentUser;
    }

    // _________________________________________________________________

    public static function userInSessionPage() {
        if (!isset($_SESSION['currentUser'])) {

            self::redirect('/009/sign-in');
        } 
    }

    public static function userInSessionSigning() {
        if (isset($_SESSION['currentUser'])) {

            self::redirect('/009');
        }
    }

    // _________________________________________________________________


    public static function redirect ($url) {
        echo  '<script language="javascript">window.location.href ="'.$url.'"</script>';;
    }
}