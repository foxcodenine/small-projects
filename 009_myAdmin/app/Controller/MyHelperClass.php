<?php

namespace app\Controller;

use app\Model\DBConnect;
use PDO;

class MyHelperClass {

    public static function emailInDB($email) {        

        $sql = 'SELECT COUNT(email) AS "count" FROM User WHERE email = :email GROUP BY email';

        $conn = DBConnect::getConn();

        $stmt = $conn -> prepare($sql);

        $stmt -> bindValue(':email', $email);

        $stmt -> execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return (bool) (int) $result->count;       
    }
}