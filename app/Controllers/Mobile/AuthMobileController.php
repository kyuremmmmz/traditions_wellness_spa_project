<?php
namespace Project\App\Controllers\Mobile;


use Project\App\Controllers\Web\RegistrationController;
use Project\App\Mail\UserMailer;
use Project\App\Models\AuthModel;
use Project\App\Models\RolesModel;
use Project\App\Models\UserAuthModel;
use Project\App\Models\UserRolesModel;

class AuthMobileController
{
    private $controller;
    private $controller2;
    private $webController;
    private $mail;
    public function __construct(){
        $this->controller = new UserAuthModel();
        $this->controller2 = new UserRolesModel();
        $this->controller2 = new RolesModel();
        $this->webController = new AuthModel();
        $this->mail = new UserMailer();
    }
    public function registration()
    {
        $file = json_decode(file_get_contents('php://input'), true);
        if (isset($file['phone'])) {
            $findPhone = $this->webController->findByPhone($file['phone']);
            if (is_array($findPhone) && $file['phone'] === $findPhone['phone']) {
                http_response_code(401);
                echo json_encode([
                    'message' => 'This phone already exist'
                ]);
                $_SESSION['error'] = [
                    'message' => 'This phone already exist'
                ];
            }else{
                $response = $this->controller->create(
                    $file['lastName'],
                    $file['firstName'],
                    $file['gender'],
                    $file['phone'],
                    password_hash($file['password'], PASSWORD_BCRYPT),
                    $file['email']
                );
                $this->mail->authMailer(
                    $file['email'],
                    'Good day! ' . $file['first_name'] . ', This is your Vaerification code please do not share this code below',
                    'Verification: ' . $file['first_name'],
                    $file['first_name']
                );
                echo json_encode([
                    'message' => 'Signed up successfully',
                    'status' => $response
                ]);
                $_SESSION['success'] = [
                    'message' => 'Signed up successfully'
                ];
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