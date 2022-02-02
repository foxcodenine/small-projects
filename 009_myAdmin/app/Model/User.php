<?php

namespace app\Model;

use app\Controller\MyCript;
use app\Controller\MyHelperClass;
use app\Model\DBConnect;
use PDO;
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
            $this->accountState = 'Nonactivated';
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

    public function updateUser() {

        try {

            $conn = DBConnect::getConn();

            $sql = " UPDATE User SET 
                firstUserName = :firstUserName,
                lastUserName  = :lastUserName,
                email         = :email,
                passHash      = :passHash,
                accountState  = :accountState,
                roleGroup     = :roleGroup,
                signUpDate    = :signUpDate,
                lastLogin     = :lastLogin,
                token         = :token
                WHERE id      = :id 
            ";

            $stmt = $conn -> prepare($sql);
            
            $stmt -> bindValue(':id', $this->id);
            $stmt -> bindValue(':firstUserName', $this->firstUserName);
            $stmt -> bindValue(':lastUserName', $this->lastUserName);
            $stmt -> bindValue(':email', $this->email);
            $stmt -> bindValue(':passHash', $this->passHash);
            $stmt -> bindValue(':accountState', $this->accountState);
            $stmt -> bindValue(':roleGroup', $this->roleGroup);
            $stmt -> bindValue(':signUpDate', $this->signUpDate);
            $stmt -> bindValue(':lastLogin', $this->lastLogin);
            $stmt -> bindValue(':token', $this->token);

            $stmt -> execute();

        } catch (PDOException $e) {
            die("Error updateUser: <br>" . $e->getMessage());
        }      
    }
    // _________________________________________________________________

    public function deleteThisUser () {

        try {

            $conn = DBConnect::getConn();
            $sql = 'DELETE FROM User WHERE id = :id';

            $stmt = $conn -> prepare($sql);
            $stmt -> bindValue(':id', $this->id);
            $stmt -> execute();


        } catch (PDOException $e) {
            die("Error deleteThisUser: <br>" . $e->getMessage());
        }
    }

    // _________________________________________________________________

    public static function getUserById ($userId) {

        try {
        
            $conn = DBConnect::getConn();
            $sql = 'SELECT * FROM User WHERE id = :id';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindValue(':id', $userId);
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_OBJ);
            $stdClass = $stmt -> fetch();

            if (!$stdClass) return false;
                    
            $user = new self (
                email: $stdClass->email,
                passHash: $stdClass->passHash,
                id: $stdClass->id,
                firstUserName: $stdClass->firstUserName,
                lastUserName: $stdClass->lastUserName,
                accountState: $stdClass->accountState,
                roleGroup: $stdClass->roleGroup,
                signUpDate: $stdClass->signUpDate,
                lastLogin: $stdClass->lastLogin,
                token: $stdClass->token,
            );

            return $user;

        } catch (PDOException $e) {
            die("Error getUserById: <br>" . $e->getMessage());
        }
    }
    // _________________________________________________________________

    public function removeNonactivatedUser () {


        if (MyHelperClass::whoami() === 'productionServer') {
            
            $schema   = $_ENV['DB_SCHEMA_PRO'];
            $user  = MyCript::decrypt($_ENV['DB_USERNAME_PRO']);
            $password = MyCript::decrypt($_ENV['DB_PASSWORD_PRO']);
        }

        if (MyHelperClass::whoami() === 'develepmentHome') {

            $schema   = $_ENV['DB_SCHEMA_DEV'];
            $user   = MyCript::decrypt($_ENV['DB_USERNAME_DEV']);
            $password = MyCript::decrypt($_ENV['DB_PASSWORD_DEV']);
        }


        
        $userId = $this->id;
        $passHash = $this->passHash;
        
        $command = './app/bash/removeNonactivatedUser.sh' . " {$user} {$password} {$schema} {$userId} " . "'\"" . $passHash . "\"'";


        MyHelperClass::runBackgroundProsess($command);

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

    /** Get the value of accountState */ 
    public function getAccountState() {
        return $this->accountState;
    }

    /** Set the value of accountState */ 
    public function setAccountState ($accountState) {
        $this->accountState = $accountState;
        return $this;
    }
}