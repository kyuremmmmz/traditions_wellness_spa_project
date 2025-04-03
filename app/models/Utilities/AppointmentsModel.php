<?php

namespace Project\App\Models\Utilities;

use PDO;
use Project\App\Config\Connection;

class AppointmentsModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM appointments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllServices()
    {
        $stmt = $this->pdo->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTotal()
    {
        $stmt = $this->pdo->query("SELECT 
                SUM(status='pending' ) AS pending, 
                SUM(status='cancelled') AS cancelled,
                SUM(status='upcoming') AS upcoming,
                SUM(status='review') AS review, 
                SUM(status='completed') AS completed, 
                SUM(status='ongoing') AS ongoing, 
                SUM(status = 'pending') + SUM(status = 'cancelled') + 
                SUM(status = 'review') + SUM(status = 'completed') + 
                SUM(status = 'upcoming') + SUM(status='ongoing') AS total
                FROM appointments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByNumber($number)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :number");
        $stmt->execute(['number' => $number]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByIdAppointment($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointments WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByStatus($status)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointments WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByDate($date)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointments WHERE booking_date = :booking_date");
        $stmt->execute(['booking_date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByDateAndTime($date, $time)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM appointments WHERE booking_date = :booking_date AND start_time = :start_time");
        $stmt->execute([
            'booking_date' => $date,
            'start_time' => $time
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND role = 'Customer'");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCustomer($firstName, $lastName, $gender, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (
            first_name,
            last_name,
            gender,
            email,
            role,
            created_at,
            updated_at
        ) VALUES (
            :first_name,
            :last_name,
            :gender,
            :email,
            'Customer',
            NOW(),
            NOW()
        )");

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $gender,
            'email' => $email
        ]);

        return $this->pdo->lastInsertId();
    }

    public function findByRole($role)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE role = :role");
        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByRoleTherapist()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM therapist");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data)
    {
        // If an array is passed, directly insert the data
        if (is_array($data)) {
            // Prepare columns and values
            $columns = [];
            $placeholders = [];
            $params = [];

            // Add automatic timestamps if not provided
            $data['created_at'] = $data['created_at'] ?? date('Y-m-d H:i:s');
            $data['updated_at'] = $data['updated_at'] ?? date('Y-m-d H:i:s');

            // Build columns, placeholders, and params
            foreach ($data as $column => $value) {
                $columns[] = $column;
                $placeholders[] = ":$column";
                $params[$column] = $value;
            }

            // Construct the SQL query
            $sql = "INSERT INTO appointments (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            // Return the last inserted ID
            return $this->pdo->lastInsertId();
        }
        
        // If not an array, throw an exception
        throw new \InvalidArgumentException("Create method requires an array of data");
    }
    
    // Helper method to check if columns exist in a table
    private function checkColumnsExist($columnNames)
    {
        $result = [];
        foreach ($columnNames as $columnName) {
            try {
                $sql = "SHOW COLUMNS FROM appointments LIKE '$columnName'";
                $stmt = $this->pdo->query($sql);
                $result[$columnName] = $stmt->rowCount() > 0;
            } catch (\Exception $e) {
                $result[$columnName] = false;
            }
        }
        return $result;
    }

    public function update(
        $duration,
        $booking_date,
        $total_price,
        $party_size,
        $service_booked,
        $start_time,
        $id
    ) {
        $stmt = $this->pdo->prepare("UPDATE appointments SET 
            total_price = :total_price,
            booking_date = :booking_date,
            start_time = :start_time,
            service_booked = :service_booked,
            party_size = :party_size,
            duration = :duration,
            updated_at = NOW()
            WHERE id = :id");
        $data = [
            'start_time' => $start_time,
            'booking_date' => $booking_date,
            'service_booked' => $service_booked,
            'total_price' => $total_price,
            'party_size' => $party_size,
            'duration' => $duration,
            'id' => $id
        ];
        return $stmt->execute($data);
    }
    
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM appointments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function searchCustomer($search)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM users 
            WHERE (CONCAT(first_name, ' ', last_name) LIKE :search 
            OR email LIKE :search)
            AND role = 'Customer'
            LIMIT 5
        ");
        $searchTerm = "%{$search}%";
        $stmt->execute(['search' => $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkAvailability($appointmentDate, $appointmentTime)
{
    try {
        // Convert time to the correct format if needed
        $startTime = date('H:i:s', strtotime($appointmentTime));
        
        // Prepare SQL query to count appointments on the specific date and time
        $sql = "SELECT COUNT(*) as appointment_count 
                FROM appointments 
                WHERE booking_date = :date 
                AND start_time = :time";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':date', $appointmentDate);
        $stmt->bindParam(':time', $startTime);
        $stmt->execute();
        
        // Fetch the count of appointments
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return true if fewer than 5 appointments exist
        return $result['appointment_count'] < 5;
    } catch (\Exception $e) {
        // Log the error
        error_log('Availability check error: ' . $e->getMessage());
        
        // In case of any error, consider the slot unavailable
        return false;
    }
}
}