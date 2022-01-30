<?php

namespace app\Model;

use app\Controller\MyCript;
use app\Model\DBConnect;
use PDOException;

class User {
    private $id;
    private $firstUserName;
    private $lastUserName;
    private $email;
    private $passHash;
    private $accountState;
    private $roleGroup;
    private $signUpDate;
    private $lastLogin;
    private $token;

    // _________________________________________________________________

    public function __construct ($email, $passHash, 
        $id=null, $firstUserName=null, $lastUserName=null, $accountState=null, 
        $roleGroup=null, $signUpDate=null, $lastLogin=null, $token=null) {

            $this->id = $id;
            $this->email = $email;
            $this->passHash = $passHash;
            $this->firstUserName = $firstUserName;
            $this->lastUserName = $lastUserName;
            $this->accountState = $accountState;
            $this->roleGroup = $roleGroup;
            $this->signUpDate = $signUpDate;
            $this->lastLogin = $lastLogin;
            $this->token = $token;
            
            if (!$this->id) { $this->addUserToDB(); }

            return $this;
    }
    // _________________________________________________________________

    public function addUserToDB () {

        try {

            $this->passHash = MyCript::passHash($this->passHash);
            $this->accountState = 'Not-Validated';
            $this->roleGroup = 'Demo';
            $this->signUpDate = date(DBConnect::DT_FORMAT, time());

            $conn = DBConnect::getConn();

            $sql = " INSERT INTO User (email, passHash,  accountState, roleGroup, signUpDate, firstUserName, lastUserName)
                    VALUES (:email, :passHash, :accountState, :roleGroup, :signUpDate, :firstUserName, :lastUserName)";

            $stmt = $conn -> prepare($sql);

            $stmt -> bindValue(':email', $this->email);
            $stmt -> bindValue(':passHash', $this->passHash);
            $stmt -> bindValue(':accountState', $this->accountState);
            $stmt -> bindValue(':roleGroup', $this->roleGroup);
            $stmt -> bindValue(':signUpDate', $this->signUpDate);
            $stmt -> bindValue(':firstUserName', $this->firstUserName);
            $stmt -> bindValue(':lastUserName', $this->lastUserName);

            $stmt -> execute();
            $this->id = $conn->lastInsertId();



        } catch (PDOException $e) {
            die("Error __construct: <br>" . $e->getMessage());
        }
    }
    // _________________________________________________________________

    /** Get the value of id */ 
    public function getId() {
        return $this->id;
    }

    /** Get the value of passHash */ 
    public function getPassHash() {
        return $this->passHash;
    }

}