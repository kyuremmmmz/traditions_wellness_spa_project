<?php
namespace Project\App\Models\Utilities;
use Project\App\Config\Connection;
use PDO;
class AppointmentsModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT first_name, last_name, id, userID,  FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByNumber($number)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :number");
        $stmt->execute(['number' => $number]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->execute(['id' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByRole($role)
    {
        $stmt = $this->pdo->prepare("SELECT first_name, last_name, role  FROM users WHERE role = :role ");
        $stmt->execute(['role' => $role]);
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
        $hrs,
        $therapist_id
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
        hrs,
        therapist_id,
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
        :hrs,
        :therapist_id,
        NOW(), 
        NOW()
    )");

        return $stmt->execute([
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
            'status' => $status,
            'hrs' => $hrs,
            'therapist_id' => $therapist_id
        ]);
    }


    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE your_table_name SET column1 = :value1, column2 = :value2 WHERE id = :id");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}