<?php

namespace app\Model;

use app\Model\DBConnect;
use PDO;
use PDOException;

class Client {
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


	public static function initClientList() {		
		$ClientList = new \SplObjectStorage();
	}

	public static function updatedClientList() {
		
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
	public function getstrAddr() {
		return $this->strAddr;
	}

	/** Set the value of strAddr */
	public function setstrAddr($strAddr) {
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
}