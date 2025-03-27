<?php
namespace Project\App\Controllers\Mobile;

use PDO;
use Project\App\Models\Services\ServicesModel;
use Project\App\Config\Connection;

class OnlineAppointmentMobileController
{
    private $pdo;
    private $servicesModel;

    public function __construct()
    {
        $this->pdo = Connection::connection();
        if ($this->pdo === null) {
            throw new \Exception("Failed to establish a database connection.");
        }
        $this->servicesModel = new ServicesModel();
    }

    public function index()
    {
        // Get all available services for appointments
        $services = $this->servicesModel->getAllServiceName();
        ob_clean();
        echo json_encode([
            'status' => 'success',
            'services' => $services
        ]);
    }

    public function getAvailableTimeSlots()
    {
        // Get date from request
        $date = $_GET['date'] ?? date('Y-m-d');
        
        // Fetch available time slots for the given date
        $stmt = $this->pdo->prepare("SELECT time_slot FROM appointments WHERE appointment_date = :date AND status != 'cancelled'");
        $stmt->execute(['date' => $date]);
        $bookedSlots = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Generate all possible time slots (e.g., 9 AM to 5 PM, hourly)
        $allSlots = [];
        for ($hour = 9; $hour < 17; $hour++) {
            $timeSlot = sprintf("%02d:00:00", $hour);
            $allSlots[] = [
                'time' => $timeSlot,
                'available' => !in_array($timeSlot, $bookedSlots)
            ];
        }
        
        ob_clean();
        echo json_encode([
            'status' => 'success',
            'date' => $date,
            'timeSlots' => $allSlots
        ]);
    }

    public function store()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate required fields
        if (!isset($data['service_id'], $data['appointment_date'], $data['time_slot'])) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required fields'
            ]);
            return;
        }
        
        try {
            // Check if the time slot is available
            $stmt = $this->pdo->prepare("SELECT id FROM appointments WHERE appointment_date = :date AND time_slot = :time AND status != 'cancelled'");
            $stmt->execute([
                'date' => $data['appointment_date'],
                'time' => $data['time_slot']
            ]);
            
            if ($stmt->fetch()) {
                throw new \Exception('Time slot is already booked');
            }
            
            // Create the appointment
            $stmt = $this->pdo->prepare("INSERT INTO appointments (service_id, user_id, appointment_date, time_slot, status, created_at) VALUES (:service_id, :user_id, :date, :time, 'pending', NOW())");
            $stmt->execute([
                'service_id' => $data['service_id'],
                'user_id' => $data['user_id'] ?? null,
                'date' => $data['appointment_date'],
                'time' => $data['time_slot']
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Appointment created successfully',
                'appointment_id' => $this->pdo->lastInsertId()
            ]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        try {
            // Verify appointment exists
            $stmt = $this->pdo->prepare("SELECT * FROM appointments WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$appointment) {
                throw new \Exception('Appointment not found');
            }
            
            // Update appointment
            $stmt = $this->pdo->prepare("UPDATE appointments SET status = :status, updated_at = NOW() WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'status' => $data['status'] ?? $appointment['status']
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Appointment updated successfully'
            ]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            // Soft delete - mark appointment as cancelled
            $stmt = $this->pdo->prepare("UPDATE appointments SET status = 'cancelled', updated_at = NOW() WHERE id = :id");
            $stmt->execute(['id' => $id]);
            
            if ($stmt->rowCount() === 0) {
                throw new \Exception('Appointment not found');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Appointment cancelled successfully'
            ]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}