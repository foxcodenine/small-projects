<?php
namespace app\Model;

use PDO;
use PDOException;

class ImageProject {

    public static $codeList;

    private $id;
    private $urlPath;
    private $position;
    private $code;
    private $cover;
    private $projectID;
    private $userID;

	const IMAGE_HANDLERS = [
		IMAGETYPE_JPEG => [
			'load' => 'imagecreatefromjpeg',
			'save' => 'imagejpeg',
			'quality' => 72,
		],
		IMAGETYPE_PNG => [
			'load' => 'imagecreatefrompng',
			'save' => 'imagepng',
			'quality' => 0
		]
	];


    public function __construct($projectID=null, $userID=null,
        $id=null, $urlPath=null, $position=null, $code=null, $cover=null ) {

        $this->setId($id);
        $this->setUrlPath($urlPath);
        $this->setPosition($position);
        $this->setCode($code);
        $this->setCover($cover);
        $this->setProjectID($projectID);
        $this->setUserID($userID);
        
        return $this;
    }

    // _________________________________________________________________


    public function updateImageToDB() {

		try {

			$conn = DBConnect::getConn();

			$sql = 'UPDATE ImageProject SET 
						urlPath 	= :urlPath,
						position 	= :position,
						code		= :code,
						cover		= :cover, 
						userID		= :userID,
						projectID	= :projectID
					WHERE id = :id';

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':id', 		$this->getId());
			$stmt->bindValue(':urlPath', 	$this->getUrlPath());
			$stmt->bindValue(':position', 	$this->getPosition());
			$stmt->bindValue(':code', 		$this->getCode());
			$stmt->bindValue(':cover', 		$this->getCover());
			$stmt->bindValue(':userID', 	$this->getUserID());
			$stmt->bindValue(':projectID', 	$this->getProjectID());

			$stmt->execute();

		} catch (PDOException $e) {

			$msg = "Error ImageProject updateImageToDB: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
        
        return $this;
    }



    // _________________________________________________________________


    public function createAwsImageStr ($name) {        

        $img_format = explode('.', $name);

        $img_format = end($img_format);

        $img_code = self::createImageCode($img_format);

        $userID = $this->getUserID();

        $projectID = $this->getProjectID();

        $this->setCode("{$img_code}.{$img_format}");

        return "user{$userID}/poject{$projectID}/images/{$img_code}.{$img_format}";  

    }

    public function uploadToAwa ($name, $tmp_name) {
        $aws_str = $this->createAwsImageStr($name);

        return  AwsClass::uploadImage($aws_str, $tmp_name);         
    }


	// _________________________________________________________________

	public function saveToDb() {

		try {

			$conn = DBConnect::getConn();

			$sql = 'INSERT INTO ImageProject (urlPath, position, code,  cover, userID,  projectID)
					VALUES (:urlPath, :position, :code, :cover, :userID, :projectID)';

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':urlPath', 	$this->getUrlPath());
			$stmt->bindValue(':position', 	$this->getPosition());
			$stmt->bindValue(':code', 		$this->getCode());
			$stmt->bindValue(':cover', 		$this->getCover());
			$stmt->bindValue(':userID', 	$this->getUserID());
			$stmt->bindValue(':projectID', 	$this->getProjectID());

			$this->setId($conn->lastInsertId());

			$stmt->execute();


		} catch (PDOException $e) {

			$msg = "Error ImageProject saveToDb: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}	
	}

	// _________________________________________________________________

	// public function removeFromAws() {
	// 	$userID 	= $this->getUserID();
	// 	$projectID 	= $this->getProjectID();
	// 	$code 		= $this->getCode();

	// 	return  AwsClass::removeImage("user{$userID}/poject{$projectID}/images/{$code}"); 
	// }

    // _________________________________________________________________	




    // _________________________________________________________________

	public function createThumbnail() {

		$src = $this->getUrlPath();
		$dest = "/tmp/{$this->getCode()}";
		$targetWidth = (int) $_ENV['THUMBNAIL_WIDTH'];
		$targetHeight = null;


		$type = exif_imagetype($src);

		// if no valid type or no handler found -> exit
		if (!$type || !self::IMAGE_HANDLERS[$type]) {
			return null;
		}

		// load the image with the correct loader
		$image = call_user_func(self::IMAGE_HANDLERS[$type]['load'], $src);

		// no image found at supplied location -> exit
		if (!$image) {
			return null;
		}

		// get original image width and height
		$width = imagesx($image);
		$height = imagesy($image);


		// maintain aspect ratio when no height set
		if ($targetHeight == null) {

			// get width to height ratio
			$ratio = $width / $height;
	
			// if is portrait
			// use ratio to scale height to fit in square
			if ($width > $height) {
				$targetHeight = floor($targetWidth / $ratio);
			}
			// if is landscape
			// use ratio to scale width to fit in square
			else {
				$targetHeight = $targetWidth;
				$targetWidth = floor($targetWidth * $ratio);
			}
		}



		// create duplicate image based on calculated target size
		$thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);

		// set transparency options for  PNGs
		if ( $type == IMAGETYPE_PNG) {
	
			// make image transparent
			imagecolortransparent(
				$thumbnail,
				imagecolorallocate($thumbnail, 0, 0, 0)
			);
	
			// additional settings for PNGs
			if ($type == IMAGETYPE_PNG) {
				imagealphablending($thumbnail, false);
				imagesavealpha($thumbnail, true);
			}
		}
	
		// copy entire source image to duplicate image and resize
		imagecopyresampled(
			$thumbnail,
			$image,
			0, 0, 0, 0,
			$targetWidth, $targetHeight,
			$width, $height
		);

		call_user_func(
			self::IMAGE_HANDLERS[$type]['save'],
			$thumbnail,
			$dest,
			self::IMAGE_HANDLERS[$type]['quality']			
		);

		$aws_str = "user{$this->getUserID()}/poject{$this->getProjectID()}/thumbnails/{$this->getCode()}";

		return  AwsClass::uploadImage($aws_str, $dest);
	}




    // _________________________________________________________________



    public static function createImageCode ($img_format)  {
        
        $codeList = self::getCodeList();
        
        $code = str_pad((string) rand(0, 999999), 6, '0', STR_PAD_LEFT);

        if (in_array("{$code}.{$img_format}", $codeList)) {
            return self::createImageCode($img_format , $codeList);
        }

        array_push($codeList, "{$code}.{$img_format}");

        return $code;
    }

    // _________________________________________________________________



    public static function getCodeList() {

        if (!self::$codeList) {
            self::updateCodeList();
        }
        return self::$codeList;
    }

    // _________________________________________________________________


    public static function updateCodeList() {

		try {

			$conn = DBConnect::getConn();
			$sql  = 'SELECT code FROM ImageProject';

			$stmt = $conn->prepare($sql);

			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_OBJ);

			self::$codeList = array_map(function($img){ return $img->code; }, $result);

		} catch (PDOException $e) {

			$msg = "Error ImageProject updateCodeList: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
    }

    // _________________________________________________________________

	public static function removeAllProjectImagesFromDb ($id) {

		try {

			$conn = DBConnect::getConn();

			$sql = 'DELETE FROM ImageProject WHERE ProjectID = :ProjectID';

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':ProjectID', $id);

		} catch (PDOException $e) {

			$msg = "Error ImageProject removeProjectCover: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
	}

    // _________________________________________________________________

	public static function removeCoverFromDb ($id) {

		try {

			$conn = DBConnect::getConn();

			$sql = 'UPDATE ImageProject SET cover = NULL WHERE ProjectID = :ProjectID';

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':ProjectID', $id);

			$stmt->execute();

		} catch (PDOException $e) {

			$msg = "Error ImageProject removeProjectCover: <br>" . $e->getMessage();
			error_log($msg);
			die($msg);
		}
	}

    // _________________________________________________________________

	public static function coverIsSet ($id) {

		try {

			$conn = DBConnect::getConn();

			$sql = 'SELECT * FROM ImageProject WHERE ProjectID = :ProjectID AND cover = 1 LIMIT 1' ;

			$stmt = $conn->prepare($sql);

			$stmt->bindValue(':ProjectID', $id);

			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return (bool) count($result);

		} catch (PDOException $e) {

			$msg = "Error ImageProject removeProjectCover: <br>" . $e->getMessage();
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


	public function getThumbnail() {
		return str_replace('images', 'thumbnails', $this->urlPath);
	}

	/** Get the value of urlPath */
	public function getUrlPath() {
		return $this->urlPath;
	}

	/** Set the value of urlPath */
	public function setUrlPath($urlPath) {
		$this->urlPath = $urlPath;

		return $this;
	}

	/** Get the value of position */
	public function getPosition() {
		return $this->position;
	}

	/** Set the value of position */
	public function setPosition($position) {
		$this->position = $position;

		return $this;
	}

	/** Get the value of code */
	public function getCode() {
		return $this->code;
	}

	/** Set the value of code */
	public function setCode($code) {
		$this->code = $code;

		return $this;
	}

	/** Get the value of projectID */
	public function getProjectID() {
		return $this->projectID;
	}

	/** Set the value of projectID */
	public function setProjectID($projectID) {
		$this->projectID = $projectID;

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