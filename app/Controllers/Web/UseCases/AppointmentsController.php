<?php

namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Project\App\Models\Utilities\AppointmentsModel;

use function Symfony\Component\Clock\now;

class AppointmentsController
{
    private $controller;
    private $reusables;
    public function __construct()
    {
        $this->controller = new AppointmentsModel();
        $this->reusables = new ReusablesController();
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
        if (!isset($file['customer_type'])) {
            echo json_encode([
                'message' => 'Required fields are missing'
            ]);
        }
        
        $findServiceByID = $this->controller->findById($file['service_booked']);
        if (isset($file['hiddenValue'])) {
            $findUsers = $this->controller->findByNumber($file['hiddenValue']);
            http_response_code(200);
            $addOnsPrice = $file['hot_stone'] + $file['swedish'] + $file['deep_tissue'];
            $addOns = $this->reusables->addOns($file);
            $price = 1000;
            $endTime = $this->reusables->durationCalculation($file['start_time'], $file);
            $pricing = $this->reusables->priceCalculation($price, $file['party_size']);
            $total = $addOnsPrice + (int)$findServiceByID['price'] + $pricing;
            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['start_time']);
            if (count($findDateAndTime) < 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
            } else {
                $this->controller->create(
                    $name,
                    $findUsers['id'],
                    $findUsers['address'],
                    $findUsers['phone'],
                    $file['start_time'],
                    $endTime,
                    $total,
                    $addOns,
                    $file['service_booked'],
                    $file['date'],
                    'pending',
                    $file['duration'],
                    $findServiceByID['serviceName'],
                    $file['party_size'],
                    $findUsers['gender'],
                    $findUsers['email']
                );
                $_SESSION['message'] = [
                    'message' => 'Appointment created successfully',
                ];
                header('Location: /appointments');
            }
        } else {
            $findServiceByID = $this->controller->findById($file['service_booked']);
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['start_time']);
            if (count($findDateAndTime) > 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
            } else {
                $addOnsPrice = $file['hot_stone'] + $file['swedish'] + $file['deep_tissue'];
                $addOns = $this->reusables->addOns($file);
                $price = 1000;
                $endTime = $this->reusables->durationCalculation($file['start_time'], $file);
                $pricing = $this->reusables->priceCalculation($price, $file['party_size']);
                $total = $addOnsPrice + (int)$findServiceByID['price'] + $pricing;
                $this->controller->create(
                    $file['first_name'] .' '. $file['last_name'],
                    1,
                    'Ayala Ave, Quezon City',
                    '09083217645',
                    $file['start_time'],
                    $endTime,
                    $total,
                    $addOns,
                    $file['service_booked'],
                    $file['date'],
                    'pending',
                    $file['duration'],
                    $findServiceByID['serviceName'],
                    $file['party_size'],
                    $file['gender'],
                    $file['customer_email']
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
        $services = $this->controller->getAllServices();
        echo json_encode([
            $appointment,
            $services
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
