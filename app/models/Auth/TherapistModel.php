<?php
namespace Project\App\Models\Auth;

use PDO;
use Project\App\Config\Connection;

class TherapistModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM your_table_name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByPhone($phone)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->execute(['phone' => $phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTherapist($therapist_id, $first_name, $last_name)
    {
        $stmt = $this->pdo->prepare("INSERT 
        INTO therapist (
        therapist_id, 
        first_name, 
        last_name, 
        start_time,
        end_time,
        date, 
        created_at, 
        updated_at) 
        VALUES (
        :therapist_id,
        :last_name,
        :first_name,
        NULL, 
        NULL,
        NULL,
        NOW(), 
        NOW())");
        return $stmt->execute([
            'therapist_id' => $therapist_id,
            'first_name' => $first_name,
            'last_name' => $last_name
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