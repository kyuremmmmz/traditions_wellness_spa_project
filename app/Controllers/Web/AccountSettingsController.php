<?php
namespace Project\App\Controllers\Web;

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

    public function delete($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AccountSettingsController for ID: $id.";
    }
}