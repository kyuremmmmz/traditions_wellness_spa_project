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
        error_log('Received service_booked: ' . $file['service_booked']);

        if (!isset($file['first_name']) && !isset($file['last_name'])) {
            echo json_encode(['message' => 'Required fields are missing']);
            return;
        }

        $findUsers = $this->controller->findByNumber($file['hiddenValue']);
        $findServiceByID = $this->controller->findById($file['service_booked']);

        if ($findServiceByID === false) {
            echo json_encode(['error' => 'Invalid service ID: ' . $file['service_booked']]);
            return;
        }

        if ($findUsers) {
            http_response_code(200);
            $addOnsPrice = (float)$file['body_massage'] + (float)$file['body_scrub'] + (float)$file['hotstone'] + (float)$file['earcandling'];
            $total = $addOnsPrice + $findServiceByID['price'];
            $name = $file['first_name'] . ' ' . $file['last_name'];
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['time']);

            if ($findDateAndTime > 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = ['therapistError' => 'Appointment Busy'];
                header('Location: /appointments');
                exit;
            } else {
                $minute = explode(':', $file['time']);
                $durationMinute = explode(':', $file['duration']);
                $startTime = (int)$minute[0] * 60 + (int)$minute[1];
                $duration = (int)$durationMinute[0] * 60 + (int)$durationMinute[1];
                $addOns = isset($file['addOns']) ? $file['addOns'] * 3 : 0;
                $this->controller->create(
                    $name,
                    $findUsers['id'],
                    $findUsers['address'],
                    $findUsers['phone'],
                    $file['time'],
                    $file['time'],
                    $total,
                    'Hilot ko HAHAHAHAHAH',
                    $file['service_booked'],
                    $file['date'],
                    'pending',
                    '2'
                );
                $_SESSION['message'] = ['message' => 'Appointment created successfully'];
                header('Location: /appointments');
                exit;
            }
        } else {
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['start_time']);
            if ($findDateAndTime > 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = ['therapistError' => 'Appointment Busy'];
                header('Location: /appointments');
                exit;
            } else {
                $addOnsPrice = $file['body_massage'] + $file['body_scrub'] + $file['hotstone'] + $file['earcandling'];
                $total = $addOnsPrice + (int) $findServiceByID['price'];
                $this->controller->create(
                    $file['first_name'] . ' ' . $file['last_name'],
                    1,
                    'Ayala Ave, Quezon City',
                    '09083217645',
                    $file['start_time'],
                    $file['start_time'],
                    $total,
                    'Hilot ko HAHAHAHAHAH',
                    $file['service_booked'],
                    $file['date'],
                    'pending',
                    '2'
                );
                $_SESSION['message'] = ['message' => 'Appointment created successfully'];
                header('Location: /appointments');
                exit;
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
        echo json_encode([
            $appointment,
        ]);
        exit;
    }

    public function getAllTotal()
    {
        ob_clean();
        $appointmentTotal = $this->controller->getAllTotal();
        echo json_encode($appointmentTotal);
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
