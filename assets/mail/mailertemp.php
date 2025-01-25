<?php
namespace Project\Assets\Mail;
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';

class Mailer{
    private $mail;
    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'kurosawataki84@gmail.com';
        $this->mail->Password = 'zfgotlmvrajybkzs';
        $this->mail->Port = 465;
        $this->mail->FromName = 'Traditions Wellness Spa';
    }
    public static function sendVerification($to, $subject, $message){
        
    }
}