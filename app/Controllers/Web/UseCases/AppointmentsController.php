<?php

namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Project\App\Models\Utilities\AppointmentsModel;

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
        header('Content-Type: application/json');
        $file = $_POST;
        $errors = [];

        // Validate source of booking
        if (!isset($file['source_of_booking']) || empty($file['source_of_booking'])) {
            $errors['source_of_booking_error'] = 'Source of booking is required';
        }

        // Validate customer type and related fields
        if ($file['customer_type'] === 'new_guest') {
            if (empty($file['first_name'])) {
                $errors['FirstNameError'] = 'First name is required';
            }
            if (empty($file['last_name'])) {
                $errors['LastNameError'] = 'Last name is required';
            }
            if (empty($file['gender'])) {
                $errors['GenderError'] = 'Gender is required';
            }
            if (empty($file['customer_email'])) {
                $errors['customerEmailError'] = 'Email is required';
            } elseif (!filter_var($file['customer_email'], FILTER_VALIDATE_EMAIL)) {
                $errors['customerEmailError'] = 'Invalid email format';
            } else {
                $existingUser = $this->controller->findByEmail($file['customer_email']);
                if ($existingUser) {
                    $errors['customerEmailError'] = 'Email already exists';
                }
            }
        } elseif ($file['customer_type'] === 'existing') {
            if (empty($file['existing_customer_id'])) {
                $errors['SearchCustomerError'] = 'Please select a customer';
            } else {
                $existingCustomer = $this->controller->findById($file['existing_customer_id']);
                if (!$existingCustomer) {
                    $errors['SearchCustomerError'] = 'Selected customer not found';
                }
            }
        }

        // Validate service booking
        $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $file['start_time']);
        if ($findDateAndTime > 5) {
            $errors['therapistError'] = 'Appointment Busy';
        }

        // If there are any errors, return them
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            return;
        }

        try {
            $customerId = null;
            
            if ($file['customer_type'] === 'new_guest') {
                // Create new customer
                $customerId = $this->controller->createCustomer(
                    $file['first_name'],
                    $file['last_name'],
                    $file['gender'],
                    $file['customer_email']
                );
            } else {
                // Use existing customer
                $existingCustomer = $this->controller->findById($file['existing_customer_id']);
                $customerId = $existingCustomer['id'];
            }

            // Get service details
            $findServiceByID = $this->controller->findById($file['service_booked']);
            
            // Calculate total price
            $addOnsPrice = array_sum($file['addons'] ?? []);
            $total = $addOnsPrice + $findServiceByID['price'];

            // Create appointment
            $this->controller->create(
                $file['customer_type'] === 'new_guest' 
                    ? $file['first_name'] . ' ' . $file['last_name']
                    : $existingCustomer['first_name'] . ' ' . $existingCustomer['last_name'],
                $customerId,
                $file['customer_type'] === 'new_guest' ? 'New Customer' : $existingCustomer['address'],
                $file['customer_type'] === 'new_guest' ? '' : $existingCustomer['phone'],
                $file['start_time'],
                $file['start_time'],
                $total,
                $file['source_of_booking'],
                $file['service_booked'],
                $file['date'],
                'pending',
                '2'
            );

            echo json_encode(['success' => true, 'message' => 'Appointment created successfully']);
            return;

        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Failed to create appointment']);
            return;
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
