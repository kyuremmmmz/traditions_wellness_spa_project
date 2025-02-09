<?php

namespace Project\App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\autoload.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\Exception.php';

class UserMailer{
    private $mailer;
    public function __construct(){
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Mailer = 'smtp';
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'kurosawataki84@gmail.com';
        $this->mailer->Password = 'zfgo tlmv rajy bkzs';
        $this->mailer->Port = 465;
        $this->mailer->setFrom('kurosawataki84@gmail.com', 'Traditions Wellness Spa');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    }

    public function appointmentMailer($to, $subject, $username, $tempPassword, $firstName) {
        //TODO: implement the mailer in here after login
    }
}