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
        $stmt = $this->pdo->prepare("SELECT *  FROM users WHERE role = :role ");
        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByRoleTherapist()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM therapist");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create(
        $nameOfTheUser,
        $user_id,
        $address,
        $contactNumber,
        $start_time,
        $end_time,
        $total_price,
        $addOns,
        $services_id,
        $booking_date,
        $status,
        $duration,
        $service_booked,
        $partysize,
        $gender,
        $email,
    ) {
        $stmt = $this->pdo->prepare("INSERT INTO appointments (
        nameOfTheUser, 
        user_id,
        address,
        contactNumber,
        start_time,
        end_time,
        total_price,
        addOns,
        services_id,
        booking_date,
        status,
        duration,
        service_booked,
        party_size,
        gender,
        email,
        created_at,
        updated_at
    ) VALUES (
        :nameOfTheUser, 
        :user_id,
        :address,
        :contactNumber,
        :start_time,
        :end_time,
        :total_price,
        :addOns,
        :services_id,
        :booking_date,
        :status,
        :duration,
        :service_booked,
        :party_size,
        :gender,
        :email,
        NOW(), 
        NOW()
    )");

        $exe = $stmt->execute([
            'nameOfTheUser' => $nameOfTheUser,
            'user_id' => $user_id,
            'address' => $address,
            'contactNumber' => $contactNumber,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'total_price' => $total_price,
            'addOns' => $addOns,
            'services_id' => $services_id,
            'booking_date' => $booking_date,
            'status' => ucfirst(str_replace('', '', $status)),
            'duration' => $duration,
            'service_booked' => $service_booked,
            'party_size' => $partysize,
            'gender' => $gender,
            'email' => $email
        ]);

        return $exe;
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
}
