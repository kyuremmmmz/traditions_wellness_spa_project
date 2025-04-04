<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Auth\UserAuthModel;
use Project\App\Models\Therapist\TherapistModel;
class TherapistController
{
    private $controller;
    private $userController;
    public function __construct()
    {
        $this->controller = new TherapistModel();
        $this->userController = new UserAuthModel();
    }

    public function addTherapist()
    {
        session_start();
        $data = $_POST;
        if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['email']) || !isset($data['phone'])) {
            $_SESSION['server_error'] = [
                'error' => 'Please fill out all fields.'
            ];
            header('Location:/employees');
        }
        $response = $this->controller->create(
            $data['first_name'], 
            $data['last_name'], 
            $data['gender'], 
            $data['status'], 
            $data['email']);
            
        if ($response) {
            $_SESSION['sumakses'] = [
                'sumakses' => 'Therapist registered successfully.'
            ];
            header('Location:/employees');
        }
    }

    public function updateTherapist(){
        session_start();
        $data = $_POST;
        if (!isset($data['first_name']) || 
            !isset($data['last_name']) || 
            !isset($data['email']) || 
            !isset($data['gender']) || 
            !isset($data['status'])) 
        {
            $_SESSION['server_error'] = [
                'error' => 'Please fill out all fields.'
            ];
            header('Location:/employees');
        }
        $update = $this->controller->update(
            $data['id'], 
            $data['first_name'], 
            $data['last_name'], 
            $data['gender'], 
            $data['status'], 
            $data['email']);
        if ($update) {
            $_SESSION['sumakses'] = [
                'sumakses' => 'Therapist updated successfully.'
            ];
            header('Location:/employees');
        }else{
            $_SESSION['server_error'] = [
                'error' => 'Failed to update therapist.'
            ];
            header('Location:/employees');
        }
    }

    public function getAllTherapist()
    {
        ob_clean();
        $data = $this->controller->getAll();
        echo json_encode($data);
        exit;
    }

    public function getAllUsers()
    {
        ob_clean();
        $data = $this->userController->getAll();
        echo json_encode($data);
        exit;
    }
    public function getTherapistByStatus($status)
    {
        ob_clean();
        $data = $this->controller->findByStatus($status);
        echo json_encode($data);
        exit;
    }
}