<?php

namespace app\Model;

use app\Model\MyCript;
use app\Model\MyUtilities;
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

            $stmt -> bindValue(':email', base64_encode($this->email));
            $stmt -> bindValue(':passHash', $this->passHash);
            $stmt -> bindValue(':accountState', $this->accountState);
            $stmt -> bindValue(':roleGroup', $this->roleGroup);
            $stmt -> bindValue(':signUpDate', $this->signUpDate);
            $stmt -> bindValue(':firstUserName', $this->firstUserName);
            $stmt -> bindValue(':lastUserName', $this->lastUserName);
          

            $stmt -> execute();
            $this->id = $conn->lastInsertId();



        } catch (PDOException $e) {
            die("Error User addUserToDB: <br>" . $e->getMessage());
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
            $stmt -> bindValue(':email', base64_encode($this->email));
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

    public static function getUserById_Email ($userId=null, $userEmail=null) {

        $conn = DBConnect::getConn();

        if (isset($userId)) {
            $sql = 'SELECT * FROM User WHERE id = :id';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindValue(':id', $userId);

        } else if (isset($userEmail)) {
            $sql = 'SELECT * FROM User WHERE email = :email';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindValue(':email', base64_encode($userEmail));


        } else {
            return false;
        }

        try {
        
            $stmt -> execute();
            $stmt -> setFetchMode(PDO::FETCH_OBJ);
            $stdClass = $stmt -> fetch();

            if (!$stdClass) return false;


                    
            $user = new self (
                email:  base64_decode($stdClass->email),
                passHash: $stdClass->passHash,
                id: $stdClass->id,
                firstUserName: $stdClass->firstUserName,
                lastUserName: $stdClass->lastUserName,
                accountState: $stdClass->accountState,
                roleGroup: $stdClass->roleGroup,
                signUpDate: $stdClass->signUpDate,
                lastLogin: $stdClass->lastLogin,
                token: $stdClass->token                
            );

            return $user;

        } catch (PDOException $e) {
            die("Error getUserById: <br>" . $e->getMessage());
        }
    }
    // _________________________________________________________________

    public function removeUserTimer () {


        if (MyUtilities::whoami() === 'productionServer') {
            
            $schema   = $_ENV['DB_SCHEMA_PRO'];
            $user  = MyCript::decrypt($_ENV['DB_USERNAME_PRO']);
            $password = MyCript::decrypt($_ENV['DB_PASSWORD_PRO']);
        }

        if (MyUtilities::whoami() === 'develepmentHome') {

            $schema     = $_ENV['DB_SCHEMA_DEV'];
            $user       = MyCript::decrypt($_ENV['DB_USERNAME_DEV']);
            $password   = MyCript::decrypt($_ENV['DB_PASSWORD_DEV']);
            
        }
        
        $userId = $this->id;
        $passHash = $this->passHash;
        $time1       = $_ENV['REMOVE_UNACTIVATED_TIME'];
        $time2       = $_ENV['REMOVE_DEMO_TIME'];
        
        $command = './app/bash/removeUserTimer.sh' . " {$user} {$password} {$schema} {$userId} " . "'\"" . $passHash . "\"'" . " $time1 $time2";


        MyUtilities::runBackgroundProsess($command);

    }

    // _________________________________________________________________




	/** Get the value of id */
	public function getId() {
		return $this->id;
	}

	/** Set the value of id */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/** Get the value of firstUserName */
	public function getFirstUserName() {
		return $this->firstUserName;
	}

	/** Set the value of firstUserName */
	public function setFirstUserName($firstUserName) {
		$this->firstUserName = $firstUserName;
		return $this;
	}

	/** Get the value of lastUserName */
	public function getLastUserName() {
		return $this->lastUserName;
	}

	/** Set the value of lastUserName */
	public function setLastUserName($lastUserName) {
		$this->lastUserName = $lastUserName;
		return $this;
	}

	/** Get the value of email */
	public function getEmail() {
		return $this->email;
	}

	/** Set the value of email */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/** Get the value of passHash */
	public function getPassHash() {
		return $this->passHash;
	}

	/** Set the value of passHash */
	public function setPassHash($passHash) {
		$this->passHash = $passHash;
		return $this;
	}

	/** Get the value of accountState */
	public function getAccountState() {
		return $this->accountState;
	}

	/** Set the value of accountState */
	public function setAccountState($accountState) {
		$this->accountState = $accountState;
		return $this;
	}

	/** Get the value of roleGroup */
	public function getRoleGroup() {
		return $this->roleGroup;
	}

	/** Set the value of roleGroup */
	public function setRoleGroup($roleGroup) {
		$this->roleGroup = $roleGroup;
		return $this;
	}

	/** Get the value of signUpDate */
	public function getSignUpDate() {
		return $this->signUpDate;
	}

	/** Set the value of signUpDate */
	public function setSignUpDate($signUpDate) {
		$this->signUpDate = $signUpDate;
		return $this;
	}

	/** Get the value of lastLogin */
	public function getLastLogin() {
		return $this->lastLogin;
	}

	/** Set the value of lastLogin */
	public function setLastLogin($lastLogin) {
		$this->lastLogin = $lastLogin;
		return $this;
	}

	/** Get the value of token */
	public function getToken() {
		return $this->token;
	}

	/** Set the value of token */
	public function setToken($token) {
		$this->token = $token;
		return $this;
	}

}