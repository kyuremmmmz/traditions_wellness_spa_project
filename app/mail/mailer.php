<?php
namespace Project\App\Mail;
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\autoload.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\vendor\phpmailer\phpmailer\src\Exception.php';

class Mailer{
    private $mail;
    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'kurosawataki84@gmail.com';
        $this->mail->Password = 'zfgo tlmv rajy bkzs';
        $this->mail->Port = 465;
        $this->mail->setFrom('kurosawataki84@gmail.com', 'Traditions Wellness Spa');
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    }
    public function sendVerification($to, $subject, $username, $tempPassword)
    {
        try {
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = "
                <h1>Welcome to Traditions Wellness Spa!</h1>
                <p>Here are your login details:</p>
                <ul>
                    <li><strong>Username:</strong> $username</li>
                    <li><strong>Temporary Password:</strong> $tempPassword</li>
                </ul>
                <p>Please log in and update your password immediately.</p>
                <p>Thank you for choosing Traditions Wellness Spa!</p>
            ";
            $this->mail->AltBody = "Welcome to Traditions Wellness Spa! 
                Username: $username
                Temporary Password: $tempPassword
                Please log in and update your password immediately. Thank you for choosing us!";
            $this->mail->send();
            echo json_encode(
                ['status' => 'success', 'message' => 'Verification email sent successfully.']
            );
            return ['status' => 'success', 'message' => 'Verification email sent successfully.'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Error sending email: ' . $this->mail->ErrorInfo];
        }
    }
}