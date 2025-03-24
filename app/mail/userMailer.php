<?php

namespace Project\App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'PHPMailer.php';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'SMTP.php';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Exception.php';

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

    public function authMailer($to, $subject , $verifCode, $firstName) {
        //TODO: implement the mailer in here after login
        try {
            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
                <div style='background-color: #f7f7f7; padding: 20px; text-align: center;'>
                    <img src='https://example.com/logo.png' alt='Traditions Wellness Spa' style='max-width: 150px; margin-bottom: 10px;'>
                    <h1 style='color: #333; font-size: 24px; margin: 0;'>Welcome to Traditions Wellness Spa!</h1>
                </div>
                <div style='padding: 20px;'>
                    <p style='font-size: 16px; color: #555;'>Dear <strong>$firstName</strong>,</p>
                    <p style='font-size: 16px; color: #555;'>We are excited to have you on board! Below are your login credentials:</p>
                    <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>er
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Verification code:$verifCode</strong></td>
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

            $this->mailer->AltBody = "Welcome to Traditions Wellness Spa!
            Dear $firstName,
            We are excited to have you on board! Below is your verification code:
            Veification code: $verifCode
            Please log in and update your password at your earliest convenience.
            Thank you for choosing Traditions Wellness Spa!";

            $this->mailer->send();
            echo json_encode(
                ['status' => 'success', 'message' => 'Verification email sent successfully.']
            );
            return ['status' => 'success', 'message' => 'Verification email sent successfully.'];
        } catch (Exception $e) {
            http_response_code(500);
            echo 'Internal Server Error';
            return ['status' => 'error', 'message' => 'Error sending email: ' . $this->mailer->ErrorInfo];
        }
    }
    public function sendToken($to, $subject, $token, $firstName)
    {
        try {
            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 10px; overflow: hidden;'>
                <div style='background-color: #f7f7f7; padding: 20px; text-align: center;'>
                    <img src='https://example.com/logo.png' alt='Traditions Wellness Spa' style='max-width: 150px; margin-bottom: 10px;'>
                    <h1 style='color: #333; font-size: 24px; margin: 0;'>Reset your password</h1>
                </div>
                <div style='padding: 20px;'>
                    <p style='font-size: 16px; color: #555;'>Dear <strong>$firstName</strong>,</p>
                    <p style='font-size: 16px; color: #555;'>We are excited to have you on board! Below is your token:</p>
                    <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>
                        <tr>
                            <td style='padding: 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Token:</strong></td>
                            <td style='padding: 10px; border: 1px solid #ddd;'>$token</td>
                        </tr>
                    </table>
                    <p style='font-size: 16px; color: #555;'>Please log in and update your password at your earliest convenience.</p>
                    <a href='http://localhost:8000/login' style='display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;'>Reset Password</a>
                </div>
                <div style='background-color: #f7f7f7; padding: 10px; text-align: center; color: #888; font-size: 14px;'>
                    <p style='margin: 0;'>Thank you for choosing Traditions Wellness Spa!</p>
                </div>
            </div>
            ";

            $this->mailer->AltBody = "Welcome to Traditions Wellness Spa!
            Dear $firstName,
            We are excited to have you on board! Below are your login credentials:
            Token: $token
            Please log in and update your password at your earliest convenience.
            Thank you for choosing Traditions Wellness Spa!";

            $this->mailer->send();
            echo json_encode(
                ['status' => 'success', 'message' => 'Verification email sent successfully.']
            );
            return ['status' => 'success', 'message' => 'Verification email sent successfully.'];
        } catch (Exception $e) {
            http_response_code(500);
            echo 'Internal Server Error';
            return ['status' => 'error', 'message' => 'Error sending email: ' . $this->mailer->ErrorInfo];
        }
    }
    }
