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

    public function updateAppointment()
    {
        header('Content-Type: application/json');
        session_start();
        $file = $_POST;

        if (!isset($file['id']) || !isset($file['nameOfTheUser'])) {
            echo json_encode(['message' => 'Required fields are missing']);
            return;
        }

        $response = $this->controller->update(
            $file['nameOfTheUser'],
            $file['address'],
            $file['contactNumber'],
            $file['booking_date'],
            $file['price'],
            $file['addOns'],
            $file['status'],
            $file['id']
        );
        header('Location:/Tracker');
        $_SESSION['success_message'] = [
            'success_message' => 'Updated Successfully'
        ];
        echo json_encode(['status' => $response]);
    }


    public function appointCustomer()
    {
        session_start();
        $file = $_POST;
        if (!isset($file['guestCustomer']) && !isset($file['SearchCustomer'])) {
            echo json_encode([
                'message' => 'Required fields are missing'
            ]);
        }

        $findUsers = $this->controller->findByNumber($file['hiddenValue']);
        $findServiceByID = $this->controller->findById($file['service_id']);
        if ($findUsers) {
            http_response_code(200);
            $addOnsPrice = $file['body_massage'] + $file['body_scrub'] + $file['hotstone'] + $file['earcandling'];
            $total = $addOnsPrice + $findServiceByID['price'];
            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['time']);
            if ($findDateAndTime>5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
            }else{
                $this->controller->create(
                    $name,
                    $findUsers['id'],
                    $findUsers['address'],
                    $findUsers['phone'],
                    $file['time'],
                    $file['time'],
                    $total,
                    'Hilot ko  HAHAHAHAHAH',
                    $file['service_id'],
                    $file['date'],
                    'pending',
                    '2',
                );
                $_SESSION['message'] = [
                    'message' => 'Appointment created successfully',
                ];
                header('Location: /appointments');
            }
        } else {
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['time']);
            if ($findDateAndTime>5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
            }else{
                $addOnsPrice = $file['body_massage'] + $file['body_scrub'] + $file['hotstone'] + $file['earcandling'];
                $total = $addOnsPrice + $findServiceByID['price'];
                $this->controller->create(
                    $file['guestCustomer'],
                    1,
                    'Ayala Ave, Quezon City',
                    '09083217645',
                    $file['time'],
                    $file['time'],
                    $total,
                    'Hilot ko HAHAHAHAHAH',
                    $file['service'],
                    $file['date'],
                    'pending',
                    '2',
                );
                $_SESSION['message'] = [
                    'message' => 'Appointment created successfully',
                ];
                header('Location: /appointments');
            }
        }
    }

    public function searchTherapist()
    {
        ob_clean();
        $response = $this->controller->getAll();
        echo json_encode($response);
        exit;
    }

    public function fetchAppointments(): array
    {
        ob_clean();
        $appointment = $this->controller->getAll();
        echo json_encode($appointment);
        exit;
    }


    public function searchCustomer()
    {
        ob_clean();
        $response = $this->controller->findByRole('Customer');
        echo json_encode($response);
        exit;
    }

    public function deleteAppointment()
    {
        $file = $_POST;
        $response = $this->controller->delete($file['id']);
        header('Location: /Tracker');
    }
}
