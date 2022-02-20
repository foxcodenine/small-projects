<?php

namespace app\Model;

use app\Model\DBConnect;
use Exception;
use PDO;
use PDOException;

use JsonSerializable;

class Client  implements JsonSerializable {
    private $id;
    private $title;
    private $firstname;
    private $lastname;
    private $idCard;
    private $company;
    private $email;
    private $phone;
    private $mobile;
    private $strAddr;
    private $postcode;
    private $localityName;
    private $countryName;
    private $userID;

	public static $ClientList = null;

    // _________________________________________________________________

	public function __construct ( $firstname, $lastname, 
		$id=null, $title=null, $idCard=null, $company=null, $email=null, 
		$phone=null, $mobile=null, $strAddr=null, $postcode=null, 
		$localityName=null, $countryName=null, $userID=null
	) {
		$this->setId($id);
		$this->setTitle($title);
		$this->setFirstname($firstname);
		$this->setLastname($lastname);
		$this->setIdCard($idCard);
		$this->setCompany($company);
		$this->setEmail($email);
		$this->setPhone($phone);
		$this->setMobile($mobile);
		$this->setstrAddr($strAddr);
		$this->setPostcode($postcode);
		$this->setLocalityName($localityName);
		$this->setCountryName($countryName);
		$this->setUserID($userID);

		if (!isset($id) || empty($id)) {
			$this->addClientToDB();
			self::addToClientList($this);
		}

		return $this;
	}

	// _________________________________________________________________

    public function addClientToDB() {	
		
		try {
			$conn = DBConnect::getConn();

			$sql = 'INSERT INTO Client (
				title, firstname, lastname, idCard, company, email, phone, mobile, 
				strAddr, postcode, localityName, countryName, userID
			) VALUES (
				:title, :firstname, :lastname, :idCard, :company, :email, :phone, 
				:mobile, :strAddr, :postcode, :localityName, :countryName, :userID
			)';

			$stmt = $conn->prepare($sql);

			$stmt -> bindValue(':title', 		$this->getTitle());
			$stmt -> bindValue(':firstname',	$this->getFirstname());
			$stmt -> bindValue(':lastname', 	$this->getLastname());
			$stmt -> bindValue(':idCard', 		$this->getIdCard());
			$stmt -> bindValue(':company', 		$this->getCompany());
			$stmt -> bindValue(':email', 		$this->getEmail());
			$stmt -> bindValue(':phone', 		$this->getPhone());
			$stmt -> bindValue(':mobile', 		$this->getMobile());
			$stmt -> bindValue(':strAddr',		$this->getstrAddr());
			$stmt -> bindValue(':postcode', 	$this->getPostcode());
			$stmt -> bindValue(':localityName', $this->getLocalityName());
			$stmt -> bindValue(':countryName', 	$this->getCountryName());
			$stmt -> bindValue(':userID', 		$this->getUserID());

			$stmt -> execute();
			$this->id = $conn->lastInsertId();

		} catch (PDOException $e) {
			$msg = "Error Client __construct: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
    }

	// _________________________________________________________________

	public static function deleteClientsFromDB (...$clientIds) {

		// Function is stutic to delete multiple client in one query

		if (empty($clientIds)) return;

		try {

			// ----- Ceate SQL string

			$sql_start = 'DELETE FROM Client WHERE';

			$sql_array = array_map( function ($client_id) {
				return " userID = :userID AND id =  :id{$client_id}";
			}, $clientIds);

			$sql_end = implode(' OR ', $sql_array);

			$sql = $sql_start . $sql_end;

			// ----- Get coon and prepare

			$conn = DBConnect::getConn();
			$stmt = $conn->prepare($sql);		

			// ----- Bind data

			$userID = MyUtilities::checkCookieAndReturnUser()->getId();
			$stmt->bindValue(":userID", $userID);

			foreach($clientIds as $client_id) {
				$stmt->bindValue(":id{$client_id}", $client_id);
			}

			// ----- Execute and update clientsList

			$stmt -> execute();	
			self::updateClientList();				

		} catch (PDOException $e) {
			$msg = "Error Client deleteClientsFromDB: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		} 
	}

	// _________________________________________________________________
	
	public function updateClientToDB () {

		try {
			// ---- updateing client in db
			$conn = DBConnect::getConn();

			$sql = 'UPDATE Client SET 
					title		= :title, 		
					firstname	= :firstname,
					lastname	= :lastname, 	
					idCard		= :idCard, 		
					company		= :company, 		
					email 		= :email, 		
					phone		= :phone, 		
					mobile		= :mobile, 		
					strAddr		= :strAddr,		
					postcode   	= :postcode, 	
					localityName = :localityName,
					countryName  = :countryName
					WHERE id = :id';
			
			$stmt = $conn->prepare($sql);

			$localityName = empty($this->getLocalityName()) ? null : $this->getLocalityName();
			$countryName  = empty($this->getCountryName()) ? null :  $this->getCountryName();

			$stmt -> bindValue(':id', 			$this->getId());
			$stmt -> bindValue(':title', 		$this->getTitle());
			$stmt -> bindValue(':firstname',	$this->getFirstname());
			$stmt -> bindValue(':lastname', 	$this->getLastname());
			$stmt -> bindValue(':idCard', 		$this->getIdCard());
			$stmt -> bindValue(':company', 		$this->getCompany());
			$stmt -> bindValue(':email', 		$this->getEmail());
			$stmt -> bindValue(':phone', 		$this->getPhone());
			$stmt -> bindValue(':mobile', 		$this->getMobile());
			$stmt -> bindValue(':strAddr',		$this->getstrAddr());
			$stmt -> bindValue(':postcode', 	$this->getPostcode());
			$stmt -> bindValue(':localityName', $localityName);
			$stmt -> bindValue(':countryName', 	$countryName);

			$stmt -> execute();


			// ---- updateing clientList
			if (!self::checkForClientList()) {self::updateClientList();}
			self::$ClientList[$this->getId()] = $this;


		} catch (PDOException $e) {
			$msg = "Error Client updateClient: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		} 	
	}

	// _________________________________________________________________

	public function infoInDb () {

		try {

			$conn = DBConnect::getConn();
			$sql = 'SELECT * FROM InfoClient WHERE userID = :userID AND clientID = :clientID LIMIT 1'; 

			$userID = unserialize($_SESSION['currentUser'])->getId();
			
			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':userID', $userID);
			$stmt->bindValue(':clientID', $this->getId());

			$stmt->execute();
			return (bool) $stmt->fetch(PDO::FETCH_ASSOC) ?? 0;

		} catch (PDOException $e) {

			$msg = "Error Client infoInDb: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
	}

	// _________________________________________________________________

	public function info($crud, $info='') {


		$crud = strtolower($crud);

		if (!in_array($crud, ['read', 'create', 'update', 'delete'])) {
			throw new Exception('Client Info: Not Valid CRUD option'); exit();
		}

		if ($crud === 'update' && strlen(trim($info)) < 1) {
			$crud = 'delete';
		} elseif ($crud === 'update' && !$this->infoInDb()) {
			$crud = 'create';
		}


		// _____________________________________________________________

		try {

			$conn = DBConnect::getConn();
			$sql = '';
			$userID = unserialize($_SESSION['currentUser'])->getId();
			
			if ($crud == 'read') {
				$sql = 'SELECT info FROM InfoClient WHERE clientID = :clientID  AND userID = :userID';

				$stmt = $conn->prepare($sql);
			
				$stmt->bindValue(':clientID', $this->getId());
				$stmt->bindValue(':userID', $userID);	
				$stmt->execute();

				$result = $stmt->fetch(PDO::FETCH_ASSOC)['info'] ?? '';
				return html_entity_decode($result);
			};



			// ---------------------------------------------------------

			switch ($crud) {
				case 'create':
					$sql = 'INSERT INTO InfoClient (info, userID, clientID) VALUES (:info, :userID, :clientID)';
					break;
				case 'update':
					$sql = 'UPDATE InfoClient SET info = :info WHERE clientID = :clientID  AND userID = :userID';
					break;
				case 'delete':
					$sql = 'DELETE FROM InfoClient WHERE clientID = :clientID  AND userID = :userID';
					break;
			}

			$stmt = $conn->prepare($sql);
			
			if ($crud === 'create' || $crud === 'update'){
				$stmt->bindValue(':info', $info);
			}
			$stmt->bindValue(':clientID', $this->getId());
			$stmt->bindValue(':userID', $userID);

			$stmt->execute();

		} catch (PDOException $e) {

			$msg = "Error Client info: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
	}

	// _________________________________________________________________


	public static function checkForClientList() {				
		return isset(self::$ClientList) && !empty(self::$ClientList);
	}
	
	// _________________________________________________________________

	public static function addToClientList($newClient) {			
		
		if (!self::checkForClientList()) {self::updateClientList();}
		self::$ClientList[$newClient->getId()] = $newClient;
	}

	// _________________________________________________________________
	
	public static function updateClientList() {
		
		if (!isset($_SESSION['currentUser']) || empty($_SESSION['currentUser']))  {
			MyUtilities::redirect($_ENV['BASE_PATH']);	exit();
		}
		// _____________________________________

		self::$ClientList = array();

		$conn  = DBConnect::getConn();

		$currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();

		$sql = 'SELECT * FROM Client WHERE userID = :userID';

		$stmt = $conn->prepare($sql);

		$stmt->bindValue(':userID', $userID);

		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($result as $c) {
			$client = new self(
				$c->firstname, $c->lastname, $c->id, $c->title,  $c->idCard, $c->company, $c->email, $c->phone,  
				$c->mobile, $c->strAddr, $c->postcode, $c->localityName, $c->countryName, $c->userID
			);

			self::$ClientList[$client->getId()] = $client; 				
		}
	}

	public static function getClientList () {
		if (!self::checkForClientList()) {self::updateClientList();}
		return self::$ClientList;
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

	/** Get the value of title */
	public function getTitle() {
		return $this->title;
	}

	/** Set the value of title */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/** Get the value of firstname */
	public function getFirstname() {
		return $this->firstname;
	}

	/** Set the value of firstname */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
		return $this;
	}

	/** Get the value of lastname */
	public function getLastname() {
		return $this->lastname;
	}

	/** Set the value of lastname */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
		return $this;
	}

	/** Get the value of idCard */
	public function getIdCard() {
		return $this->idCard;
	}

	/** Set the value of idCard */
	public function setIdCard($idCard) {
		$this->idCard = $idCard;
		return $this;
	}

	/** Get the value of company */
	public function getCompany() {
		return $this->company;
	}

	/** Set the value of company */
	public function setCompany($company) {
		$this->company = $company;
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

	/** Get the value of phone */
	public function getPhone() {
		return $this->phone;
	}

	/** Set the value of phone */
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}

	/** Get the value of mobile */
	public function getMobile() {
		return $this->mobile;
	}

	/** Set the value of mobile */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
		return $this;
	}

	/** Get the value of strAddr */
	public function getStrAddr() {
		return $this->strAddr;
	}

	/** Set the value of strAddr */
	public function setStrAddr($strAddr) {
		$this->strAddr = $strAddr;
		return $this;
	}

	/** Get the value of postcode */
	public function getPostcode() {
		return $this->postcode;
	}

	/** Set the value of postcode */
	public function setPostcode($postcode) {
		$this->postcode = $postcode;
		return $this;
	}

	/** Get the value of localityName */
	public function getLocalityName() {
		return $this->localityName;
	}

	/** Set the value of localityName */
	public function setLocalityName($localityName) {
		$this->localityName = $localityName;
		return $this;
	}

	/** Get the value of countryName */
	public function getCountryName() {
		return $this->countryName;
	}

	/** Set the value of countryName */
	public function setCountryName($countryName) {
		$this->countryName = $countryName;
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

	// _________________________________________________________________

	public function jsonSerialize () {

		$json = array();

		foreach ($this as $poperty => $value ) {			
			$json[$poperty] = $value;
		}
		return $json;
	}
}