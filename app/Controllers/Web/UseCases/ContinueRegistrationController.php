<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Auth\ResetPasswordModel;

class ContinueRegistrationController
{
    private $controller;
    private $fileUpload;
    public function __construct(){
        $this->controller = new ResetPasswordModel();
        $this->fileUpload = new FileUploadUseCaseController();
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
                $photo = $_FILES['imgUpload']['tmp_name'];
                $upload = $this->fileUpload->imageUpload($photo);
                $uploadStep2 = $this->controller->uploadPhoto($upload['image']['url'],$firstResponse['email']);
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