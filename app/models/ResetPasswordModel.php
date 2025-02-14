<?php
namespace Project\App\Models;

use PDO;
use Project\App\Config\Connection;

class ResetPasswordModel
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

    public function findByPreviousUserName($previousUname)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $previousUname]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO your_table_name (column1, column2) VALUES (:value1, :value2)");
        return $stmt->execute($data);
    }

    public function changePassword($password, $username, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'username' => $username,
            'password' => $password
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}