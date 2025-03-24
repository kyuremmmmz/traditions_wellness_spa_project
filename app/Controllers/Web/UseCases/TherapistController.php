<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Models\Therapist\TherapistModel;
class TherapistController
{
    private $controller;
    public function __construct()
    {
        $this->controller = new TherapistModel();
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

    public function getAllTherapist()
    {
        ob_clean();
        $data = $this->controller->getAll();
        echo json_encode($data);
        exit;
    }
}