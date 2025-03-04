<?php

namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Project\App\Models\Utilities\AppointmentsModel;

use function Symfony\Component\Clock\now;

class AppointmentsController
{
    private $controller;
    public function __construct()
    {
        $this->controller = new AppointmentsModel();
    }
    public function index()
    {
        // Code for listing resources
        echo "This is the index method of AppointmentsController.";
    }
    /*
    TO FIX: 
    - addOnss
    - duration calculation
    */
    public function appointCustomer()
    {
        session_start();
        $file = $_POST;
        if (!isset($file['guestCustomer']) && !isset($file['SearchCustomer'])) {
            echo json_encode([
                'message' => 'Required fields are missing'
            ]);
        }

        $findUsers = $this->controller->findByNumber(trim($file['hiddenValue']));
        $findServiceByID = $this->controller->findById($file['service']);
        if ($findUsers) {
            http_response_code(200);
            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];
            $this->controller->create(
                $name,
                $findUsers['id'],
                $findUsers['address'],
                $findUsers['phone'],
                $file['time'],
                $file['time'],
                $findServiceByID['price'],
                'Hilot ko gago HAHAHAHAHAH',
                $file['service'],
                'pending',
                '2',
            );
            $_SESSION['message'] = [
                'message' => 'Appointment created successfully',
            ];
            header('Location: /appointments');
        } else {
            $this->controller->create(
                $file['guestCustomer'],
                1,
                'Ayala Ave, Quezon City',
                '09083217645',
                $file['time'],
                $file['time'],
                $findServiceByID['price'],
                'Hilot ko gago HAHAHAHAHAH',
                $file['service'],
                'pending',
                '2',
            );
            $_SESSION['message'] = [
                'message' => 'Appointment created successfully',
            ];
            header('Location: /appointments');
        }
    }

    public function searchTherapist()
    {
        ob_clean();
        $response = $this->controller->getAll();
        echo json_encode($response);
        exit;
    }


    public function searchCustomer()
    {
        ob_clean();
        $response = $this->controller->findByRole('Customer');
        echo json_encode($response);
        exit;
    }
}
