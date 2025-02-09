<?php
namespace Project\App\Controllers\Mobile;


use Project\App\Models\UserAuthModel;

class AuthMobileController
{
    private $controller;
    public function __construct(){
        $this->controller = new UserAuthModel();
    }
    public function registration()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['phone'])) {
            $response = $this->controller->create(
                $file['lastName'], 
                $file['firstName'], 
                $file['gender'], 
                $file['phone'], 
                password_hash($file['password'], PASSWORD_BCRYPT));
            if ($response) {
                
            }
        }
    }

    public function login()
    {
        //TODO: IMPLEMENT THE LOGIN LOGIC AFTER REGISTRATION
        header('Content-Type:application-json');
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['phone'])) {
            echo json_encode(
                [
                    'message' => 'success'
                ]
            );
        }
    }

    public function forgotPassword($id)
    {
        // Code for showing an edit form
        echo "This is the edit method of AuthMobileController for ID: $id.";
    }

    public function forgotPasswordSend($id)
    {
        // Code for updating resources
        echo "This is the update method of AuthMobileController for ID: $id.";
    }

    public function logout($id)
    {
        // Code for deleting resources
        echo "This is the delete method of AuthMobileController for ID: $id.";
    }
}