<?php

namespace app\Model;

use app\Model\DBConnect;
use Exception;
use PDO;
use PDOException;
use JsonSerializable;


abstract class Collection  {

    protected static $tableName;
    protected static $fieldName;


    protected $id;
    protected $name;
    protected $userID;

    public function __construct ($id=NULL, $name=NULL, $userID=NULL) {
        
        $this->setId($id);
        $this->setName($name);
        $this->setUserID($userID);


		if (!isset($id) || empty($id)) {
			$this->addToDb();
		}
        
        return $this;
    }

	// __________________________________________

    public static function getList () {

        $conn = DBConnect::getConn();

        $sql =  "SELECT id, " . static::$fieldName . " as 'name',  userID ";
        $sql .= "FROM " . static::$tableName . " WHERE userID = :userID ";
        $sql .= "ORDER BY name";

        $stmt = $conn->prepare($sql);

        $currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();


        $stmt->bindValue(':userID', $userID);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $list = [];

        foreach ($results as $r) {
            $list[$r->id] =  new static($r->id, stripslashes($r->name), $r->userID);
        }

        return $list;
    }
     
	// __________________________________________


	public static function isInDb($name) {
		try {
			$conn = DBConnect::getConn();

			$sql =  "SELECT * FROM " . static::$tableName;
			$sql .= " WHERE " . static::$fieldName ."=:nname AND";
			$sql .= " userID = :userID LIMIT 1";

			$stmt = $conn->prepare($sql);

			$userId = unserialize($_SESSION['currentUser'])->getID();


			$stmt->bindValue(':nname', $name, PDO::PARAM_STR);
			$stmt->bindValue(':userID', $userId, PDO::PARAM_INT);
	
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
			return (bool) $result; 

		} catch (PDOException $e) {
			$msg = "Error Collection isInDb: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
	}
	
	// __________________________________________

	public function addToDb () {

		try {
			$conn = DBConnect::getConn();

			$sql =  "INSERT INTO " . static::$tableName;
			$sql .= " ( " . static::$fieldName .", userID ) VALUES";
			$sql .= " (:name, :userID)";

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':name',  $this->getName());
			$stmt->bindValue(':userID', $this->getUserID());

			$stmt->execute();
			$this->id = $conn->lastInsertId();	


		} catch (PDOException $e) {
			$msg = "Error Collection addToDb: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
		
	}




    // -----------------------------------------------------------------


	/** Get the value of id */
	public function getId() {
		return $this->id;
	}

	/** Set the value of id */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/** Get the value of name */
	public function getName() {
		return $this->name;
	}

	/** Set the value of name */
	public function setName($name) {
		$this->name = $name;

		return $this;
	}

	/** Get the value of userID */
	public function getUserID() {
		return $this->userID;
	}

	/** Set the value of userID */
	public function setUserID($userID) {
		$this->userID = $userID;

		return $this;
	}
}