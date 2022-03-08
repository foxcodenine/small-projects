<?php

namespace app\Model;

use app\Model\DBConnect;
use Exception;
use PDO;
use PDOException;

use JsonSerializable;

// abstract
abstract class Collection  {

    protected static $tableName;
    protected static $fieldName;


    protected $id;
    protected $name;
    protected $userID;

    public function __construct ($id, $name, $userID) {
        
        $this->setId($id);
        $this->setName($name);
        $this->setUserID($userID);
        
        return $this;
    }


    public static function getList () {

        $conn = DBConnect::getConn();

        $sql =  "SELECT id, " . static::$fieldName . " as 'name',  userID ";
        $sql .= "FROM " . static::$tableName . " WHERE userID = :userID";

        $stmt = $conn->prepare($sql);

        $currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();


        $stmt->bindValue(':userID', $userID);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $list = [];

        foreach ($results as $r) {
            $list[$r->id] =  new static($r->id, $r->name, $r->userID);
        }

        return $list;
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