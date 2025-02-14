<?php
namespace Project\App\Controllers\Web;
use Project\App\Models\ResetPasswordModel;

class ContinueRegistrationController
{
    private $controller;
    public function __construct(){
        $this->controller = new ResetPasswordModel();
    }
    public function continueRegistrationFunction()
    {
        session_start();
        $data = $_POST;
        $sessionData = $_SESSION['user']['email'];
        if (isset($data['username'])) {
            $firstResponse = $this->controller->findByPreviousUserName($sessionData);
            if (is_array($firstResponse)) {
                $password = $data['password'];
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $updateUnameAndPassword = $this->controller->changePassword($hashedPassword,$data['username'], $firstResponse['email']);
                if ($updateUnameAndPassword) {
                    echo json_encode([
                        'updatedddd' => $firstResponse
                    ]);
                }else{
                    echo json_encode([
                        'not updated' => 'theres kulang in here po'
                    ]);
                }
            }
        }
    }
}