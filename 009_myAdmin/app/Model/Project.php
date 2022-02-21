<?php

namespace app\Model;

use app\Model\DBConnect;
use Exception;
use PDO;
use PDOException;

class Project {
    private $id;
    private $projectname;
    private $strAddr;
    private $projectNo;
    private $paNo;
    private $projectDate;
    private $cover;
    private $localityName;
    private $stageName;
    private $categoryName;
    private $clientId;
    private $userID;

	private static $ProjectList = null;

	


    // _________________________________________________________________

	public function __construct( $projectname, 
		$id=null, $strAddr=null, $projectNo=null, $paNo=null, $projectDate=null, 
		$cover=null, $localityName=null, $stageName=null, $categoryName=null, 
		$clientId=null, $userID=null
	) {
		$this->setId($id); 
		$this->setProjectname($projectname); 
		$this->setStrAddr($strAddr); 
		$this->setProjectNo($projectNo); 
		$this->setPaNo($paNo); 
		$this->setProjectDate($projectDate); 		
		$this->setCover($cover); 		
		$this->setLocalityName($localityName); 
		$this->setStageName($stageName); 
		$this->setCategoryName($categoryName); 
		$this->setClientId($clientId); 
		$this->setUserID($userID);

		if (!isset($id) || empty($id)) {
			$this->addProjectToDB();
			self::addToProjectList($this);
		}
		return $this;
	}

	// _________________________________________________________________

    public function addProjectToDB() {	
		
		try {
			$conn = DBConnect::getConn();

			$sql = 'INSERT INTO Project (
				projectname, strAddr, projectNo, paNo,  projectDate, cover,
                localityName, stageName, categoryName, clientId, userID
			) VALUES (
				:projectname, :strAddr, :projectNo, :paNo,  :projectDate, :cover,
                :localityName, :stageName, :categoryName, :clientId, :userID
			)';

			$stmt = $conn->prepare($sql);

			$this->getProjectDate(date(DBConnect::DT_FORMAT, time()));

			$stmt -> bindValue(':projectname',	$this->getProjectname());
			$stmt -> bindValue(':strAddr', 	    $this->getStrAddr());
			$stmt -> bindValue(':projectNo', 	$this->getProjectNo());
			$stmt -> bindValue(':paNo', 		$this->getPaNo());
			$stmt -> bindValue(':projectDate', 	$this->getProjectDate());
			$stmt -> bindValue(':cover', 		$this->getCover());
			$stmt -> bindValue(':localityName', $this->getLocalityName());
			$stmt -> bindValue(':stageName', 	$this->getStageName());
			$stmt -> bindValue(':categoryName', $this->getCategoryName());
			$stmt -> bindValue(':clientId',     $this->getClientId());		
			$stmt -> bindValue(':userID', 		$this->getUserID());

			$stmt -> execute();
			$this->id = $conn->lastInsertId();

		} catch (PDOException $e) {
			$msg = "Error Project addProjectToDB: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
    }
	// _________________________________________________________________
	public function updateProjectToDB () {

		try {

			$conn = DBConnect::getConn();

			$sql = 'UPDATE Project SET
				projectname = :projectname, 
				localityName = :localityName, 
				strAddr = :strAddr, 
				clientId = :clientId, 
				projectNo = :projectNo, 
				paNo = :paNo,  
				stageName = :stageName, 
				categoryName = :categoryName, 
				projectDate = :projectDate
			WHERE id = :id';

			$stmt = $conn->prepare($sql);

			$localityName = empty($this->getLocalityName()) ? null : $this->getLocalityName();
			$categoryName = empty($this->getCategoryName()) ? null : $this->getCategoryName();
			$stageName    = empty($this->getStageName())    ? null : $this->getStageName();

			$stmt->bindValue(':id', 			$this->getId()); 
			$stmt->bindValue(':projectname', 	$this->getProjectname()); 
			$stmt->bindValue(':localityName', 	$localityName); 
			$stmt->bindValue(':strAddr', 		$this->getStrAddr()); 
			$stmt->bindValue(':clientId', 		$this->getClientId()); 
			$stmt->bindValue(':projectNo', 		$this->getProjectNo()); 
			$stmt->bindValue(':paNo', 			$this->getPaNo()); 
			$stmt->bindValue(':stageName', 		$stageName); 
			$stmt->bindValue(':categoryName', 	$categoryName); 
			$stmt->bindValue(':projectDate', 	$this->getProjectDate());

			$stmt -> execute();


		} catch (PDOException $e) {
			$msg = "Error Client updateClient: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		} 

		// ---- updateing clientList
		if (!self::checkForProjectList()) {self::updateProjectList();}
		self::$ProjectList[$this->getId()] = $this;
	}

	public static function checkForProjectList() {				
		return isset(self::$ProjectList) && !empty(self::$ProjectList);
	}
	
	// _________________________________________________________________

	public static function addToProjectList($newProject) {			
		
		if (!self::checkForProjectList()) {self::updateProjectList();}
		self::$ProjectList[$newProject->getId()] = $newProject;
	}

	// _________________________________________________________________

	public static function getProjectList () {
		if (!self::checkForProjectList()) {self::updateProjectList();}
		return self::$ProjectList;
	}

	// _________________________________________________________________

	public static function updateProjectList() {
		if (!isset($_SESSION['currentUser']) || empty($_SESSION['currentUser']))  {
			MyUtilities::redirect($_ENV['BASE_PATH']);	exit();
		}
		// _____________________________________

		self::$ProjectList = array();

		$conn  = DBConnect::getConn();

		$currentUser = MyUtilities::checkCookieAndReturnUser(); 
		MyUtilities::userInSessionPage();
		$userID = $currentUser->getId();

		$sql = 'SELECT * FROM Project WHERE userID = :userID';

		$stmt = $conn->prepare($sql);

		$stmt->bindValue(':userID', $userID);

		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		foreach($result as $p) {
			$project = new self( $p->projectname, 
				$p->id, $p->strAddr, $p->projectNo, $p->paNo,  $p->projectDate, $p->cover,
				$p->localityName, $p->stageName, $p->categoryName, $p->clientId, $p->userID 
			);

			self::$ProjectList[$project->getId()] = $project; 				
		}
	}

    // _________________________________________________________________

	public function fetchClientName() {

		try {

			$conn = DBConnect::getConn();

			$sql = 'SELECT firstname, lastname FROM Client WHERE id = :id LIMIT 1';

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':id', $this->getClientId());

			$stmt->execute();

			$resultClient = $stmt->fetch(PDO::FETCH_ASSOC);

			return $resultClient ? "{$resultClient['firstname']} {$resultClient['lastname']}" : '';

		} catch (PDOException $e) {

			$msg = "Error Project fetchClientName: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
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

	/** Get the value of projectname */
	public function getProjectname() {
		return $this->projectname;
	}

	/** Set the value of projectname */
	public function setProjectname($projectname) {
		$this->projectname = $projectname;
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

	/** Get the value of projectNo */
	public function getProjectNo() {
		return $this->projectNo;
	}

	/** Set the value of projectNo */
	public function setProjectNo($projectNo) {
		$this->projectNo = $projectNo;
		return $this;
	}

	/** Get the value of paNo */
	public function getPaNo() {
		return $this->paNo;
	}

	/** Set the value of paNo */
	public function setPaNo($paNo) {
		$this->paNo = $paNo;
		return $this;
	}

	/** Get the value of projectDate */
	public function getProjectDate() {
		return $this->projectDate;
	}

	/** Set the value of projectDate */
	public function setProjectDate($projectDate) {
		$this->projectDate = $projectDate;
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

	/** Get the value of stageName */
	public function getStageName() {
		return $this->stageName;
	}

	/** Set the value of stageName */
	public function setStageName($stageName) {
		$this->stageName = $stageName;
		return $this;
	}

	/** Get the value of categoryName */
	public function getCategoryName() {
		return $this->categoryName;
	}

	/** Set the value of categoryName */
	public function setCategoryName($categoryName) {
		$this->categoryName = $categoryName;
		return $this;
	}

	/** Get the value of clientId */
	public function getClientId() {
		return $this->clientId;
	}

	/** Set the value of clientId */
	public function setClientId($clientId) {
		$this->clientId = $clientId;
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

	/** Get the value of cover */
	public function getCover() {
		return $this->cover;
	}

	/** Set the value of cover */
	public function setCover($cover) {
		$this->cover = $cover;
		return $this;
	}
}