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
        
        include './app/templates/tmpEmailType1.php';
        $imgUrl = './app/static/images/email_images/image-1.jpeg';

        $title      = "Activation your <strong>MY</strong>Admin Account";
        $greadings  = "Hi {$user->getFirstUserName()},";
        $message    = "Your account has been create with <span style=\"color: #E74C3C;\">{$user->getEmail()}</span>. ";
        $message   .= "Please activate this account by click the button below.";
        $buttonText = "Activate Account";
        $subMessage = "...or by copying and pasting the following link in to your browser:";
        $imgUrl     = "https://foxcode-project-009.s3.eu-central-1.amazonaws.com/image-1.jpeg";

        $content = createEmailType1($title, $greadings, $message, $buttonText, $link, $subMessage, $imgUrl);
        $this->content('Activate You Account', $content);
        // $this->content('Activate You Account', "<a href='$link'>$link</a>");
    }
        // _________________________________________

    public function contentChangeEmail($user, $newEmail) {

        $userId      = $user->getId();
        $code        = substr(MyCript::generateKey(), 10 , 28);
        
        $user->setCode($code);
        $user->updateUser();

        $currentDate = new \DateTimeImmutable();
        $datePlus1hr = $currentDate->add(new \DateInterval('PT1H'));
        $timestamp   = $datePlus1hr->getTimestamp();

        $emailCode = base64_encode($newEmail);

        
        $link = "{$_ENV['BASE_URL']}/changeEmail/{$userId}/{$code}/{$timestamp}/$emailCode";

        include './app/templates/tmpEmailType1.php';
        $imgUrl = './app/static/images/email_images/image-1.jpeg';

        $title      = "<strong>MY</strong>Admin Email Confirmation";
        $greadings  = "Hi {$user->getFirstUserName()},";
        $message    = "You have requested to update your email address to <span style=\"color: #E74C3C;\">{$newEmail}</span>.";
        $message   .= "&nbsp; Please confirm by click the button below.";
        $buttonText = "Confirm Email";
        $subMessage = "...or by copying and pasting the following link in to your browser:";
        $imgUrl     = "https://foxcode-project-009.s3.eu-central-1.amazonaws.com/image-1.jpeg";

        $content = createEmailType1($title, $greadings, $message, $buttonText, $link, $subMessage, $imgUrl);
        $this->content('Update Email Address', $content);

    }

    // _________________________________________

    public function contentRecoverPassword($user) {

        $userId      = $user->getId();
        $code        = substr(MyCript::generateKey(), 10 , 28);
        
        $user->setCode($code);
        $user->updateUser();

        $currentDate = new \DateTimeImmutable();
        $datePlus1hr = $currentDate->add(new \DateInterval('PT1H'));
        $timestamp   = $datePlus1hr->getTimestamp();


        $link = "{$_ENV['BASE_URL']}/password-reset-{$userId}-{$code}-{$timestamp}";

        include './app/templates/tmpEmailType1.php';
        $imgUrl = './app/static/images/email_images/image-1.jpeg';

        $title      = "<strong>MY</strong>Admin Password Recover";
        $greadings  = "Hi {$user->getFirstUserName()},";
        $message    = "We have received a request to reset the password that is associated with this email address ";
        $message   .= "<span style=\"color: #E74C3C;\">{$user->getEmail()}</span>. &nbsp; ";
        $message   .= "Please click the button below to securely reset your password.";
        $buttonText = "Reset Password";
        $subMessage = "...or by copying and pasting the following link in to your browser:";
        $imgUrl     = "https://foxcode-project-009.s3.eu-central-1.amazonaws.com/image-1.jpeg";

        $content = createEmailType1($title, $greadings, $message, $buttonText, $link, $subMessage, $imgUrl);
        $this->content('Password Recovery', $content);

    }
    // _________________________________________

    public function contentRecoverPasswordInvalidEmail() {

        include './app/templates/tmpEmailType3.php';
        $imgUrl = './app/static/images/email_images/image-1.jpeg';

        $title      = "<strong>MY</strong>Admin Password Recover";
        $message    = "A request has been received to reset the password associated with this email address. ";
        $message   .= "However no account is associated with this email.";
        $imgUrl     = "https://foxcode-project-009.s3.eu-central-1.amazonaws.com/image-1.jpeg";

        $content = createEmailType3($title, $message, $imgUrl);
        $this->content('Invalid Email', $content);

    }
    // _________________________________________

    public function contentPasswordHaveChanged($user) {

        $email = $user->getEmail() ?? '';
        $codedEmail = base64_encode($email);

        $link = "{$_ENV['BASE_URL']}/sign-out/password-recover";

        $link = $email ? "{$link}-{$codedEmail}" : $email;

       
        include './app/templates/tmpEmailType2.php';
        $imgUrl = './app/static/images/email_images/image-1.jpeg';

        $title      = "Your Password was Changed";
        $greadings  = "Hi {$user->getFirstUserName()},";
        $message    = "The password for your MyAdmin account was changed. &nbsp; ";
        $message   .= "If you require to change your password again you can click ";
        $message   .= "<a style=\"color: blue;text-decoration: none;\" href='$link'>here</a> to submit a new request.";
        // $buttonText = "Confirm Email";
        $subMessage = "...or by copying and pasting the following link in to your browser:";
        $imgUrl     = "https://foxcode-project-009.s3.eu-central-1.amazonaws.com/image-1.jpeg";

        $content = createEmailType2($title, $greadings, $message, $link, $subMessage, $imgUrl);
        $this->content('Your password has been changed', $content);

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


