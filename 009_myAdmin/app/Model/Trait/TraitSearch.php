<?php


namespace app\Model\Trait;

use app\Model\DBConnect;
use app\Model\MyUtilities;
use PDO;

// _____________________________________________________________________

trait TraitSearch {

    public static function getSearchList ($tableName, $fieldsArray = []) {

        // _____________________________________________________________
        // --- fetch user id

        $currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();

        // _____________________________________________________________
        // --- creating array for whitelist filtering

        $whiteList = [
            'firstname', 'lastname', 'idCard', 'company', 'email', 
            'phone', 'mobile', 'strAddr', 'postcode', 'localityName', 
            'countryName', 'projectname', 'projectNo', 'paNo',
            'stageName', 'categoryName', 'clientId' 
        ];

        // _____________________________________________________________
        // --- creating sql string

        $sql  = "SELECT * FROM $tableName WHERE userID = :userID";

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
        // --- binding values

        $stmt->bindValue(':userID', $userID);

        foreach ($fieldsArray as $column => $value) {

            if (!in_array($column, $whiteList)) continue;
            if ($value === false) continue;

            $stmt->bindValue(':'. $column , $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':userID', $userID); 
        
        // ____________________________________________________________
        // --- executing
        
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);        
 
        // ____________________________________________________________
        // --- Saving result in $ClientList or $ProjectList

        self::saveResaltInList($result);

        // ____________________________________________________________
        // --- Saving list in session according Class


        if (__CLASS__ === 'app\Model\Client') {
             $_SESSION['search-client-list'] = serialize(self::$ClientList);
        }


        if (__CLASS__ === 'app\Model\Project') {
            $_SESSION['search-project-list'] = serialize(self::$ProjectList);
        }
        
        // ____________________________________________________________
        
    }
}