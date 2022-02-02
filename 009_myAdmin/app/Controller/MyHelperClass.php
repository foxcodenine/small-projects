<?php

namespace app\Controller;

use app\Model\DBConnect;
use app\Model\User;
use PDO;

class MyHelperClass {

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
}