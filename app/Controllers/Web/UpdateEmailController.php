<?php
namespace Project\App\Controllers\Web;

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
    public function update()
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
                exit();
            }else{
                
            }
        }
    }
}