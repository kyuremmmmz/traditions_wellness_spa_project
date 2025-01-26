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
    public function sendVerification($to, $subject, $username, $tempPassword, $firstName)
    {
        try {
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
                <div style='background-color: #f7f7f7; padding: 20px; text-align: center;'>
                    <img src='https://example.com/logo.png' alt='Traditions Wellness Spa' style='max-width: 150px; margin-bottom: 10px;'>
                    <h1 style='color: #333; font-size: 24px; margin: 0;'>Welcome to Traditions Wellness Spa!</h1>
                </div>
                <div style='padding: 20px;'>
                    <p style='font-size: 16px; color: #555;'>Dear <strong>$firstName</strong>,</p>
                    <p style='font-size: 16px; color: #555;'>We are excited to have you on board! Below are your login credentials:</p>
                    <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Username:</strong></td>
                            <td style='padding: 10px; border: 1px solid #ddd;'>$username</td>
                        </tr>
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Temporary Password:</strong></td>
                            <td style='padding: 10px; border: 1px solid #ddd;'>$tempPassword</td>
                        </tr>
                    </table>
                    <p style='font-size: 16px; color: #555;'>Please log in and update your password at your earliest convenience.</p>
                    <a href='https://example.com/login' style='display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;'>Log In Now</a>
                </div>
                <div style='background-color: #f7f7f7; padding: 10px; text-align: center; color: #888; font-size: 14px;'>
                    <p style='margin: 0;'>Thank you for choosing Traditions Wellness Spa!</p>
                </div>
            </div>
            ";

            $this->mail->AltBody = "Welcome to Traditions Wellness Spa!
            Dear $firstName,
            We are excited to have you on board! Below are your login credentials:
            Username: $username
            Temporary Password: $tempPassword
            Please log in and update your password at your earliest convenience.
            Thank you for choosing Traditions Wellness Spa!";

            $this->mail->send();
            echo json_encode(
                ['status' => 'success', 'message' => 'Verification email sent successfully.']
            );
            return ['status' => 'success', 'message' => 'Verification email sent successfully.'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Error sending email: ' . $this->mail->ErrorInfo];
        }
    }

    public function sendToken($to, $subject, $token, $firstName){
        try {
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
                <div style='background-color: #f7f7f7; padding: 20px; text-align: center;'>
                    <img src='https://example.com/logo.png' alt='Traditions Wellness Spa' style='max-width: 150px; margin-bottom: 10px;'>
                    <h1 style='color: #333; font-size: 24px; margin: 0;'>Reset your password</h1>
                </div>
                <div style='padding: 20px;'>
                    <p style='font-size: 16px; color: #555;'>Dear <strong>$firstName</strong>,</p>
                    <p style='font-size: 16px; color: #555;'>We are excited to have you on board! Below are your login credentials:</p>
                    <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Token:</strong></td>
                            <td style='padding: 10px; border: 1px solid #ddd;'>$token</td>
                        </tr>
                    </table>
                    <p style='font-size: 16px; color: #555;'>Please log in and update your password at your earliest convenience.</p>
                    <a href='https://example.com/login' style='display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;'>Reset Password</a>
                </div>
                <div style='background-color: #f7f7f7; padding: 10px; text-align: center; color: #888; font-size: 14px;'>
                    <p style='margin: 0;'>Thank you for choosing Traditions Wellness Spa!</p>
                </div>
            </div>
            ";

            $this->mail->AltBody = "Welcome to Traditions Wellness Spa!
            Dear $firstName,
            We are excited to have you on board! Below are your login credentials:
            Token: $token
            Please log in and update your password at your earliest convenience.
            Thank you for choosing Traditions Wellness Spa!";

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