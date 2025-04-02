<?php

namespace Project\App\Controllers\Web\UseCases;

use DateTime;
use Exception;
use Project\App\Models\Utilities\AppointmentsModel;
use Project\App\Models\Utilities\NotificationsModel;

class AppointmentsController
{
    private $controller;
    private $reusables;
    private $notification;
    
    public function __construct()
    {
        $this->controller = new AppointmentsModel();
        $this->reusables = new ReusablesController();
        $this->notification = new NotificationsModel();
    }
    
    public function updateAppointment()
    {
        header('Content-Type: application/json');
        session_start();
        $file = $_POST;

        if (!isset($file['booking_date']) || !isset($file['service_booked'])) {
            echo json_encode(['message' => 'Required fields are missing']);
            return;
        }
        
        $findDateAndTime = $this->controller->findByDateAndTime($file['booking_date'], $file['start_time']);
        if (count($findDateAndTime) >= 5) {
            $_SESSION['therapistError'] = [
                'therapistError' => 'Appointment Busy'
            ];
            header('Location:/appointments');
            exit;
        } else {
            $findById = $this->controller->findByIdAppointment($file['appointment_id']);
            $findId = $this->controller->findById($file['service_booked']);
            $originalPrice = $this->reusables->priceCalculation(1000, $findById['party_size']);
            $newPrice = $this->reusables->priceCalculation(1000, $file['party_size']);
            $calculateTotal = max((int)$findById['total_price'] + ($newPrice - $originalPrice), 0);
            $response = $this->controller->update(
                $file['duration'],
                $file['booking_date'],
                $calculateTotal,
                $file['party_size'],
                $findId['serviceName'],
                $file['start_time'],
                $file['appointment_id'],
            );
            header('Location:/appointments');
            $this->notification->create(
                $_SESSION['user']['id'],
                "{$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} has appointed you for a {$findById['serviceName']} service on {$file['date']} at {$file['start_time']}",
                'Appointment',
                'unread'
            );
            $_SESSION['success_message'] = [
                'success_message' => 'Updated Successfully'
            ];
        }
    }

    public function appointCustomer()
    {
        session_start();
        $file = $_POST;
        
        if (!isset($file['customer_type'])) {
            echo json_encode([
                'message' => 'Required fields are missing'
            ]);
            return;
        }
        
        $findServiceByID = $this->controller->findById($file['service_booked']);
        
        // Initialize add-on prices
        $addOnsPrice = 0;
        
        // Check if add-ons exist and add their prices
        if (isset($file['hot_stone'])) {
            $addOnsPrice += (int)$file['hot_stone'];
        }
        
        if (isset($file['swedish'])) {
            $addOnsPrice += (int)$file['swedish'];
        }
        
        if (isset($file['deep_tissue'])) {
            $addOnsPrice += (int)$file['deep_tissue'];
        }
        
        // Process any new add-on fields from the form
        foreach ($file as $key => $value) {
            if (strpos($key, 'addon_') === 0 && !empty($value)) {
                $addOnsPrice += (int)$value;
            }
        }
        
        // Extract massage selection and body scrub selection if available
        $massageSelection = $file['massage_selection'] ?? '';
        $bodyScrubSelection = $file['body_scrub_selection'] ?? '';
        
        $addOns = $this->reusables->addOns($file);
        $price = 1000; // Base price
        
        // Convert time format for end_time calculation
        $startTime = date('H:i:s', strtotime($file['start_time']));
        $endTime = $this->reusables->durationCalculation($startTime, $file);
        
        $pricing = $this->reusables->priceCalculation($price, $file['party_size']);
        
        // Make sure findServiceByID has a price or use a default
        $servicePrice = isset($findServiceByID['price']) ? (int)$findServiceByID['price'] : 0;
        $total = $addOnsPrice + $servicePrice + $pricing;
        
        if (isset($file['hiddenValue'])) {
            // Existing customer
            $findUsers = $this->controller->findByNumber($file['hiddenValue']);
            $name = $findUsers['first_name'] . ' ' . $findUsers['last_name'];
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $startTime);
            
            if (count($findDateAndTime) > 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
                exit;
            } else {
                $this->createAppointment(
                    $name,
                    $findUsers['id'],
                    $findUsers['address'] ?? 'N/A',
                    $findUsers['phone'],
                    $startTime,
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
                    $findUsers['email'],
                    $massageSelection,
                    $bodyScrubSelection,
                    $findServiceByID['category']
                );
            }
        } else {
            // New guest
            $findDateAndTime = $this->controller->findByDateAndTime($file['date'], $startTime);
            
            if (count($findDateAndTime) > 5) {
                http_response_code(401);
                $_SESSION['therapistError'] = [
                    'therapistError' => 'Appointment Busy'
                ];
                header('Location: /appointments');
                exit;
            } else {
                $this->createAppointment(
                    $file['first_name'] . ' ' . $file['last_name'],
                    1, // Default user ID for guests
                    'Ayala Ave, Quezon City', // Default address
                    '09083217645', // Default phone
                    $startTime,
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
                    $file['customer_email'],
                    $massageSelection,
                    $bodyScrubSelection,
                    $findServiceByID['category']
                );
            }
        }
    }
    
    // Helper method to create appointments and avoid code duplication
    private function createAppointment(
        $name,
        $userId,
        $address,
        $phone,
        $startTime,
        $endTime,
        $total,
        $addOns,
        $serviceId,
        $date,
        $status,
        $duration,
        $serviceName,
        $partySize,
        $gender,
        $email,
        $massageSelection = '',
        $bodyScrubSelection = '',
        $category
    ) {
        // Create the appointment record
        $this->controller->create(
            $name,
            $userId,
            $address,
            $phone,
            $startTime,
            $endTime,
            $total,
            $addOns,
            $serviceId,
            $date,
            $status,
            $duration,
            $serviceName,
            $partySize,
            $gender,
            $email,
            $massageSelection,
            $bodyScrubSelection,
            $category
        );
        
        // Create notification
        $this->notification->create(
            $_SESSION['user']['id'],
            "{$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} has appointed you for a {$serviceName} service on {$date} at {$startTime}",
            'Appointment',
            'unread'
        );
        
        // Set success message and redirect
        $_SESSION['message'] = [
            'message' => 'Appointment created successfully',
        ];
        
        header('Location: /appointments');
        exit;
    }

    public function checkAppointment()
    {
        // Clear any existing output
        ob_clean();
        
        // Set the correct content type
        header('Content-Type: application/json');
        
        try {
            // Get POST data from $_POST (form data)
            $data = $_POST;
            
            if (!isset($data['date']) || !isset($data['start_time']) || !isset($data['service_booked'])) {
                echo json_encode([
                    'available' => false,
                    'message' => 'Required fields are missing'
                ]);
                exit;
            }
            
            // Convert time to database format if necessary
            $startTime = date('H:i:s', strtotime($data['start_time']));
            
            // Find appointments at the same date and time
            $findDateAndTime = $this->controller->findByDateAndTime($data['date'], $startTime);
            
            // If there are 5 or more appointments at this time, it's busy
            if (count($findDateAndTime) >= 5) {
                echo json_encode([
                    'available' => false,
                    'message' => 'Appointment Busy'
                ]);
            } else {
                echo json_encode([
                    'available' => true,
                    'message' => 'Time slot is available'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'available' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
        
        exit;
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

    public function fetchAppointmentsByStatus($status): array
    {
        ob_clean();
        $appointment = $this->controller->findByStatus($status);
        echo json_encode([
            $appointment,
        ]);
        exit;
    }

    public function fetchAppointmentsByDate($date): array
    {
        ob_clean();
        $appointment = $this->controller->findByDate($date);
        echo json_encode(
            $appointment,
        );
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