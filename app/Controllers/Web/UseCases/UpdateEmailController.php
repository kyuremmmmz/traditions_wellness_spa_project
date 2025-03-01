<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Mail\Mailer;
use Project\App\Models\Settings\AccountSettingsModel;

class UpdateEmailController
{
    private $updateEmailModel;
    private $mailer;
    public function __construct(){
        $this->updateEmailModel = new AccountSettingsModel();
        $this->mailer = new Mailer();
    }
    public function updateEmail()
    {
        session_start();
        $data = $_POST;
        if (isset($data['submit'])) {
            $inputMail = $data['emailInputField'];
            if (!filter_var($inputMail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['server_error'] = [
                    'error' => 'Invalid email format.'
                ];
                header('Location: /account');
            if ($data['emailInputField'] === '') {
                http_response_code(400);
                $_SESSION['server_error'] = [
                    'error' => 'Email field cannot be empty.'
                ];
                header('Location: /account');
                exit;
            }
            }else{
                $findEmail = $this->updateEmailModel->findByEmail($inputMail);
                if (is_array($findEmail)) {
                    try {
                        $code = $this->generateCode();
                        $update = $this->updateEmailModel->updateCode($inputMail, $code);
                        if (!$update) {
                            echo json_encode(
                                [
                                    'error' => 'Email update failed. Please try again.'
                                ],
                                http_response_code(500)
                            );
                            exit();
                        }
                        $sendMail = $this->mailer->sendCode(
                            $inputMail,
                            'Good day! This is your verification code',
                            "Verification code: $code",
                            $findEmail['first_name']
                        );
                        header('Location: /verificationforchangeemail');
                        if ($sendMail['status'] === 'success') {
                            $_SESSION['server_success'] = [
                                'success' => 'Verification code sent to your email.'
                            ];
                        }
                        exit;
                    } catch (\Throwable $th) {
                        echo json_encode(
                            [
                                'error' => 'Email sending failed. Please try again.'
                            ],
                            http_response_code(500)
                        );
                        exit();
                    }
                }
            }
        }
    }

    public function findByCode()
    {
        session_start();
        $data = $_POST;
        if (isset($data['submit'])) {
            $findByCode = $this->updateEmailModel->findByToken($data['verificationInputField']);
            if (is_array($findByCode)) {
                $_SESSION['verification'] = [
                    'verification' => $data['verificationInputField']
                ];
                header('Location: /editemail');
            } else {
                $_SESSION['server_error'] = [
                    'error' => 'Invalid code. Please try again.'
                ];
                header('Location: /verificationforchangeemail');
            }
        }
    }


    public function newEmail()
    {
        session_start();
        $data = $_POST;
        if (isset($data['emailInputField'])) {
            $findByCode = $this->updateEmailModel->findByToken($_SESSION['verification']['verification']);
            if (is_array($findByCode)) {
                $this->updateEmailModel->newEmail($data['emailInputField'], $_SESSION['verification']['verification']);
                $_SESSION['user']['email'] = $data['emailInputField'];
                $this->updateEmailModel->deleteCode($_SESSION['user']['email']);
                $_SESSION['server_success'] = [
                    'success' => 'Email updated successfully.'
                ];
                header('Location: /account');
            } else {
                $_SESSION['server_error'] = [
                    'error' => 'Invalid code. Please try again.'
                ];
                header('Location: /verificationforchangeemail');
            }
        }
    }

    private function generateCode(){
        $code = rand(100000, 999999);
        return $code;
    }
}