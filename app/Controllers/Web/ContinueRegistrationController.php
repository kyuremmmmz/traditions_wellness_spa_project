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
                    header('Location:/uploadprofile');
                }else{
                    header('Location:/continueregistration');
                }
            }
        }
    }

    public function uploadProfile(){
        session_start();
        $data = $_FILES;
        $sessionPayload =  $_SESSION['user']['email'];
        if (isset($data['imgUpload'])) {
            $firstResponse = $this->controller->findByPreviousUserName($sessionPayload);
            if (is_array($firstResponse)) {
                $photo = file_get_contents($_FILES['imgUpload']['tmp_name']);
                $upload = 'data:image/jpeg;base64,' . base64_encode($photo);
                $uploadStep2 = $this->controller->uploadPhoto($upload,$firstResponse['email']);
                echo $uploadStep2;
                if ($uploadStep2) {
                    header('Location: /dashboard');
                }else{
                    header('Location: /uploadprofile');
                }
            }
        }
    }
}