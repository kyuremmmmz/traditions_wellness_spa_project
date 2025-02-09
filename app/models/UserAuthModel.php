<?php
namespace Project\App\Models;

use PDO;
use Project\App\Config\Connection;

class UserAuthModel
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

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($lastName, $firstName, $gender, $phone, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (userID ,last_name, first_name, gender, phone, password, created_at, updated_at) VALUES (:userID,:lastname, :firstname, :gender, :phone, :password, NOW(), NOW())");
        $user = random_int(100, 200);
        return $stmt->execute(
            [
                'userID' => $user,
                'lastname' => $lastName,
                'firstname' => $firstName,
                'gender' => $gender,
                'phone' => $phone,
                'password' => $password
            ]
        );
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