<?php

namespace app\Model;

use app\Model\DBConnect;
use app\Model\User;
use PDO;

class MyUtilities {

    // _________________________________________________________________

    public static function whoami () {

        if ($_ENV['APP_ENV'] === 'production' && $_SERVER['SERVER_NAME'] === 'foxcode.io') {
            return 'productionServer';
        }

        if ($_ENV['APP_ENV'] === 'development' && gethostname() === 'Inspiron16' && php_uname('s') === 'Linux') {
            return 'develepmentHome';
        }

        if ($_ENV['APP_ENV'] === 'production' && $_SERVER['SERVER_NAME'] === 'foxcode.codes') {
            return 'productionServer';
        }

        
    }

    // -----------------------------------------------------------------

    public static function runBackgroundProsess($command, $outputFile = '/dev/null') {
        $processId = shell_exec(sprintf('%s > %s 2>&1 & echo $!', $command, $outputFile ));  
        return $processId;
    }

    // -----------------------------------------------------------------

    public static function validatePhoneNumber($num) {
        return preg_match('/^[\d ]*$/', $num);
    }

    public static function validateName($name) {
        return preg_match('/^[A-Za-z\'\"]+$/', $name);
    }

    // -----------------------------------------------------------------

    public static function topBarUserFullnameRollIcon () {

        if (!isset($_SESSION['currentUser'])) return;
        
        $currentUser = unserialize($_SESSION['currentUser']);

        $firstname = $currentUser->getFirstUserName();
        $lastname = $currentUser->getLastUserName();

        $fullname = "$firstname $lastname";

        $id = str_pad($currentUser->getId(), 2, "0", STR_PAD_LEFT);
        $rollGroup = strtoupper($currentUser->getRoleGroup());

        $roll = "$id $rollGroup";

        $icon = $firstname[0] . $lastname[0];

        return [$fullname, $roll, $icon];
    }

    // -----------------------------------------------------------------

    public static function fetchSignImage() {

        $num = rand(0, 19);

        return "./app/static/images/signing/img-sign-{$num}.jpg";
    }

    // -----------------------------------------------------------------


    // -----------------------------------------------------------------


    public static function sortTable($arrList) {

        $sortCallback = function ($a, $b) {

            $method    = MyCript::stringSanitize($_GET['sortBy'] ?? 'getId');
            $sortOrder = MyCript::stringSanitize($_GET['sortOrder'] ?? 1);

            if (!(bool) $method) return;
         
          
            if ($a->$method() == $b->$method()) { 
    
                return 0;
            } else if ($sortOrder === 'ASC') {
    
                return ($a->$method() > $b->$method()) ? -1 : 1;
    
            } else {
                return ($a->$method() < $b->$method()) ? -1 : 1;
            }              
        };
    
        usort($arrList, $sortCallback);
        
        return $arrList;
    }


    // -------------------------------------------------------------------------
    // --- Check Database --- Check Database --- Check Database --- Check Databa
    // -------------------------------------------------------------------------

    public static function emailInDB($email=false) {   
        /** Check if email is alreay in database */  

        if (!isset($email) || empty($email)) return false;

        // -----------------------------------------------------

        $sql = 'SELECT COUNT(email) AS "count" FROM User WHERE email = :email GROUP BY email';

        $conn = DBConnect::getConn();

        $stmt = $conn -> prepare($sql);

        $stmt -> bindValue(':email', base64_encode($email));

        $stmt -> execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return (bool) $result;     
    }

    // -----------------------------------------------------------------

    public static function localityInDB ($locality=false) {

        if (!isset($locality) || empty($locality)) return false;

        // -----------------------------------------------------

        $userID = unserialize($_SESSION['currentUser'])->getID();

        $conn = DBConnect::getConn();

        $sql = 'SELECT * FROM Locality WHERE lName = :locality AND userID = :userID';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':locality', $locality);
        $stmt->bindValue(':userID', $userID);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (bool) $result;       
    } 

    // -----------------------------------------------------------------
    
    public static function countryInDB ($country=false) {
        
        if (!isset($country) || empty($country)) return false;
        
        // -----------------------------------------------------

        $userID = unserialize($_SESSION['currentUser'])->getID();
        
        $conn = DBConnect::getConn();
        
        $sql = 'SELECT * FROM Country WHERE cName = :country  AND userID = :userID';

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':country', $country);
        $stmt->bindValue(':userID', $userID);

        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return (bool) $result;       
    } 

    // -----------------------------------------------------------------
    
    public static function optionInDB ($table=false, $option=false) {
        
        if (!isset($table) || empty($table)) return false;
        if (!isset($option)  || empty($option)) return false;

        $table  = ucfirst(strtolower($table));
        $option = ucfirst(strtolower($option));

        
        // -----------------------------------------------------

        $userID = unserialize($_SESSION['currentUser'])->getId();
        
        $conn = DBConnect::getConn();

        $sql = '';

        switch ($table) {
            case 'Stage':
                $sql .= 'SELECT * FROM Stage    WHERE sName = :_option  AND userID = :userID';
                break;

            case 'Category':
                $sql .= 'SELECT * FROM Category WHERE yName = :_option  AND userID = :userID';
                break;

            case 'Locality':
                $sql .= 'SELECT * FROM Locality WHERE lName = :_option  AND userID = :userID';
                break;

            case 'Country':
                $sql .= 'SELECT * FROM Country  WHERE cName = :_option  AND userID = :userID';
                break;

        }        

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':_option', $option);
        $stmt->bindValue(':userID', $userID);

        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return (bool) $result;       
    } 
    

    // -------------------------------------------------------------------------
    // --- Add to Database --- Add to Database --- Add to Database --- Add to Da
    // -------------------------------------------------------------------------

    public static function insertOptionToDB($table,  $name) {

        $table = ucfirst(strtolower($table));
        $userID = unserialize($_SESSION['currentUser'])->getID();

        $sql = 'INSERT INTO ';

        switch ($table) {

            case 'Locality';
                $sql .= 'Locality (lName, userID) VALUES (:nname, :userID)';
                break;

            case 'Country';
                $sql .= 'Country (cName, userID) VALUES (:nname, :userID)';
                break;

            case 'Stage';
                $sql .= 'Stage (sName, userID) VALUES (:nname, :userID)';
                break;

            case 'Category';
                $sql .= 'Category (yName, userID) VALUES (:nname, :userID)';
                break;

        }

        $conn = DBConnect::getConn();

        $stmt = $conn->prepare($sql);       

        $stmt -> bindValue(':nname', $name, PDO::PARAM_STR);
        $stmt -> bindValue(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();
    }

    // -------------------------------------------------------------------------
    // --- Fetch from Database  --- Fetch from Database --- Fetch from Database
    // -------------------------------------------------------------------------

    public static function fetchOptionsFromDB ($table) {

        self::userInSessionPage();

        $table = ucfirst(strtolower($table));
        $userID = unserialize($_SESSION['currentUser'])->getID();

        $sql = 'SELECT ';


        switch ($table) {

            case 'Locality':
                $sql .= 'userID, lName FROM Locality WHERE userID = :userID ORDER BY lName';
                break;

            case 'Country':
                $sql .= 'userID, cName FROM Country WHERE userID = :userID ORDER BY cName';
                break;

            case 'Stage':
                $sql .= 'userID, sName FROM Stage WHERE userID = :userID ORDER BY sName';
                break;

            case 'Category':
                $sql .= 'userID, yName FROM Category WHERE userID = :userID ORDER BY yName';
                break;

            case 'Client':
                $sql .= '* FROM Client WHERE userID = :userID ORDER BY firstname, lastname, id';
                break;
        }

        $conn = DBConnect::getConn();

        $stmt = $conn->prepare($sql);       

        $stmt -> bindValue(':userID', $userID, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }


    
    
    //--------------------------------------------------------------------------
    // --- Cookie --- Cookie --- Cookie --- Cookie --- Cookie --- Cookie --- Coo
    //--------------------------------------------------------------------------

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

    public static function unsetCookie($currentUser=null) {

        // --- Updating DB -------------
        if (isset($currentUser)) {
            $currentUser->setToken('');
            $currentUser->updateUser(); 
        } 

        // --- Updating Cookie ---------

        $cookieName   = 'FOXCODE_IO|009|MYADMIN'; 
        $cookieValue  = '';                    
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
        $cookieData = $_COOKIE['FOXCODE_IO|009|MYADMIN'] ?? false;
        $cookieData = $_COOKIE['FOXCODE_IO|009|MYADMIN'] ?? false;
        

        // --- fetch user from database ---------

        if ($cookieData) {            

            $userId = MyCript::stringSanitize(json_decode($cookieData)[0]);
            $userToken = MyCript::stringSanitize(json_decode($cookieData)[1]);
            $currentUser = User::getUserById_Email($userId) ?? null;   
        }
        

        // --- Compare database with cookie ------




        if (isset($currentUser) && !empty($currentUser) && $currentUser->getToken() === $userToken) {
            $_SESSION['currentUser'] = serialize($currentUser);
            return $currentUser;
        } 

        // --- If no cookie or cookie data does not match db unset curentUser

        unset ($_SESSION['currentUser']);

        return false;
    }

    //--------------------------------------------------------------------------
    //--- User --- User --- User --- User --- User --- User --- User --- User --
    //--------------------------------------------------------------------------

    // public static function currentUserInSession() {
    //     if (isset($_SESSION['currentUser'])) {

    //         session_write_close();        
    //         header('Location: ' . $_ENV['BASE_PATH']);
    //         exit();
    //     }
    // }

    // // _________________________________________________________________

    // public static function currentUserNotInSession() {
    //     if (isset($_SESSION['currentUser'])) {
            
    //         session_write_close();        
    //         header('Location: ' . $_ENV['BASE_PATH'] . '/sign-in');
    //         exit();
    //     }
    // }
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
            self::redirect($_ENV['BASE_PATH'] . '/sign-in');
            exit();
        } 
    }

    public static function userInSessionSigning() {
        if (isset($_SESSION['currentUser'])) {
            self::redirect($_ENV['BASE_PATH']);
        }
    }

    // _________________________________________________________________


    public static function redirect ($url) {
        echo  '<script language="javascript">window.location.href ="'.$url.'"</script>';;
    }
}