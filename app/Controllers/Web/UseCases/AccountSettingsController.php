<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Settings\AccountSettingsModel;
class AccountSettingsController
{
    private $accountSettingsModel;
    public function __construct(){
        $this->accountSettingsModel = new AccountSettingsModel();
    }


    public function update()
    {
        session_start();
        $data = $_POST;
        if (isset($data['submit'])) {
            $session = $_SESSION['user'];
            $response = $this->accountSettingsModel->findByPhone($session['phone']);
            if (is_array($response)) {
                $update = $this->accountSettingsModel->update(
                    $response['id'],
                    $data['firstNameInputField'],
                    $data['lastNameInputField'],
                    $data['gender']);
                if ($update) {
                    header('Location: /account');
                    $_SESSION['user']['last_name'] = $data['lastNameInputField'];
                    $_SESSION['user']['first_name'] = $data['firstNameInputField'];
                    $_SESSION['user']['gender'] = $data['gender'];
                    $_SESSION['server_success'] = [
                        'success' => 'Account updated successfully.'
                    ];
                }else {
                    header('Location: /account');
                    http_response_code(500);
                    $_SESSION['server_error'] = [
                        'error' => 'Account update failed. Please try again.'
                    ];
                }
            }
        }else{
            http_response_code(400);
            $_SESSION['server_error'] = [
                'error' => 'Invalid request.'
            ];
        }
    }

    public function updatePassword()
    {
        session_start();
        $data = $_POST;

        if (!isset($data['oldPasswordInputField']) || !isset($data['NewPasswordInputField']) || !isset($data['ConfirmPasswordInputField'])) {
            $_SESSION['error_message'] = 'Invalid request. Missing password fields.';
            header('Location: /changepassword');
            exit;
        }

        $session = $_SESSION['user'];
        $response = $this->accountSettingsModel->findByPhone($session['phone']);

        if (!is_array($response) || empty($response['password'])) {
            $_SESSION['error_message'] = 'Unable to verify account.';
            header('Location: /changepassword');
            exit;
        }

        if (!password_verify($data['oldPasswordInputField'], $response['password'])) {
            $_SESSION['error_message'] = 'Old password is incorrect.';
            header('Location: /changepassword');
            exit;
        }

        if ($data['oldPasswordInputField'] === $data['NewPasswordInputField']) {
            $_SESSION['error_message'] = 'New password must be different from old password.';
            header('Location: /changepassword');
            exit;
        }

        if ($data['NewPasswordInputField'] !== $data['ConfirmPasswordInputField']) {
            $_SESSION['error_message'] = 'New password and confirm password do not match.';
            header('Location: /changepassword');
            exit;
        }

        $newPasswordHash = password_hash($data['ConfirmPasswordInputField'], PASSWORD_BCRYPT);
        $update = $this->accountSettingsModel->updatePassword($response['password'], $newPasswordHash);

        if ($update) {
            $_SESSION['server_success'] = 'Account updated successfully.';
            $_SESSION['user']['password'] = $newPasswordHash;
            header('Location: /account');
            exit;
        } else {
            $_SESSION['error_message'] = 'Account update failed. Please try again.';
            header('Location: /changepassword');
            exit;
        }
    }
}