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
            'countryName', 'projectname', 'projectNo', 'projectDate',
            'stageName', 'categoryName', 'clientId' 
        ];

        $sql  = "SELECT id FROM $tableName WHERE userID = :userID";


        // ____________________________________________________________


        foreach ($fieldsArray as $column => $value) {

            if (!in_array($column, $whiteList)) continue;

            $sql .= " AND $column LIKE CONCAT('%', :$column, '%')";
        }


        // ____________________________________________________________

        $conn = DBConnect::getConn();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':userID', $userID);

        // ____________________________________________________________


        foreach ($fieldsArray as $column => $value) {

            if (!in_array($column, $whiteList)) continue;

            $stmt->bindValue(':'. $column , $value);
        }

        $stmt->bindValue(':userID', $userID); 
        
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
              
    }
}