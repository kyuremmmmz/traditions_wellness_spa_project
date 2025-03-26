<?php
namespace Project\App\Models\Therapist;

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
        $stmt = $this->pdo->query("SELECT * FROM therapist");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($firstname, $lastname, $gender, $status, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO 
        therapist (first_name, last_name, gender, status, email, created_at, updated_at)
        VALUES (:first_name, :last_name, :gender, :status, :email, NOW(), NOW())");
        return $stmt->execute([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'gender' => $gender,
            'status' => $status,
            'email' => $email
        ]);
    }

    public function update($id, $first_name, $last_name, $gender, $status, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE 
        therapist SET 
        first_name = :first_name, last_name = :last_name, 
        gender=:gender, status=:status, email=:email, updated_at = NOW()
        WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'status' => $status,
            'email' => $email
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}