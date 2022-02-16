<?php

namespace app\Model;

use app\Model\MyCript;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;


class Mail {

    private static $mail;
    private $eMail;

    // _________________________________________

    public function __construct() {
        
        try {

            if (!self::$mail) self::initMailer();
            $this->eMail = clone self::$mail;           
            
            $this->eMail->setFrom($this->eMail->Username, 'MyAdmin');
                    
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo $this->eMail->ErrorInfo;
            die();
        }
    }

    // _________________________________________

    public function recipient ($toEmail, $toName) {
        $this->eMail->addAddress($toEmail, $toName);
    }

    // _________________________________________

    public function content ($subject, $body) {
        $this->eMail->isHTML(true);                                  
        $this->eMail->Subject = $subject;
        $this->eMail->Body    = $body;
        $this->eMail->AltBody = $body;
    }

    // _________________________________________
    
    public function contentAccountActivation($user) {
  
        $code = base64_encode($user->getPassHash());
        $link = $_ENV['BASE_URL'] . '/activate' . '/' . $user->getId() . '/' . $code; ;
        $this->content('Activate You Account', "<a href='$link'>$link</a>");
    }

    // _________________________________________
    
    public function send () {       

        try {
            $this->eMail->send();

        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo $this->eMail->ErrorInfo;
            die();
        }
    }

    // _________________________________________
    
    public static function initMailer () {
        
        try {
            
            $mail = new PHPMailer(true);
                       
            $host = MyCript::decrypt($_ENV['EMAIL_HOST']);
            $username = MyCript::decrypt($_ENV['EMAIL_USERNAME']);
            $password = MyCript::decrypt($_ENV['EMAIL_PASSWORD']);
            $port = $_ENV['EMAIL_PORT'];

            if ($_ENV['EMAIL_TYPE'] === 'NR') {
                $host = MyCript::decrypt($_ENV['EMAIL_HOST2']);
                $username = MyCript::decrypt($_ENV['EMAIL_USERNAME2']);
                $password = MyCript::decrypt($_ENV['EMAIL_PASSWORD2']);
                $port = $_ENV['EMAIL_PORT2'];
            }
            
            
            $mail->isSMTP();                                            
            $mail->Host       = $host;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $username;           
            $mail->Password   = $password;                              
            $mail->SMTPSecure = 'ssl';         
            $mail->Port       = $port; 

            self::$mail = $mail;

        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo $mail->ErrorInfo;
            die();
        }
    }
    // _________________________________________
}

?>


