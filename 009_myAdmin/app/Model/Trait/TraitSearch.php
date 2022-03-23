<?php


namespace app\Model\Trait;

use app\Model\DBConnect;
use app\Model\MyUtilities;
use PDO;

// _____________________________________________________________________

trait TraitSearch {

    public static function getSearchList ($tableName, $fieldsArray = []) {


        $currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();

        $whiteList = [
            'firstname', 'lastname', 'idCard', 'company', 'email', 
            'phone', 'mobile', 'strAddr', 'postcode', 'localityName', 
            'countryName', 'projectname', 'projectNo', 'paNo',
            'stageName', 'categoryName', 'clientId' 
        ];

        $sql  = "SELECT * FROM $tableName WHERE userID = :userID";


        // ____________________________________________________________


        foreach ($fieldsArray as $column => $value) {

            if (!in_array($column, $whiteList)) continue;
            if ($value === false) continue;
            if ($column === 'mobile') continue;
            


            if ($column === 'phone') {

                $sql .= "  AND (phone LIKE CONCAT('%', :phone, '%') OR mobile LIKE CONCAT('%', :mobile, '%'))";

                echo $sql;                

            } else if (in_array($column, ['countryName', 'localityName'])) {

                $sql .= " AND $column = :$column";

            }             
            else {
                
                $sql .= " AND $column LIKE CONCAT('%', :$column, '%')";
            }
            
        }

        // ____________________________________________________________
        // --- get connection

        $conn = DBConnect::getConn();
        $stmt = $conn->prepare($sql);        

        // ____________________________________________________________
        // --- binding

        $stmt->bindValue(':userID', $userID);

        foreach ($fieldsArray as $column => $value) {

            if (!in_array($column, $whiteList)) continue;
            if ($value === false) continue;

            $stmt->bindValue(':'. $column , $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':userID', $userID); 
        
        
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);        
 
        
        // return $result;
        self::saveResaltInList($result);


        if (__CLASS__ === 'app\Model\Client') {

             $_SESSION['search-client-list'] = serialize(self::$ClientList);
        }


        if (__CLASS__ === 'app\Model\Project') {

            // exit();

            $_SESSION['search-project-list'] = serialize(self::$ProjectList);
        }

        
    }
}