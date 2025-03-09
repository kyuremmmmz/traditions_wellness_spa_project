<?php
namespace Project\App\Models\Auth;

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
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $previousUname]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO your_table_name (column1, column2) VALUES (:value1, :value2)");
        return $stmt->execute($data);
    }

    public function changePassword($password, $username, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, password = :password, isFirstTimeLogin = 0 WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'username' => $username,
            'password' => $password
        ]);
    }

    public function uploadPhoto($photo, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET photos = :photo WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'photo' => $photo,
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}