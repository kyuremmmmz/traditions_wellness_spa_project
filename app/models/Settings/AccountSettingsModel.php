<?php
namespace Project\App\Models\Settings;

use PDO;
use Project\App\Config\Connection;
class AccountSettingsModel
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

    public function findByToken($verifCode)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE verifCode = :verifCode");
        $stmt->execute(['verifCode' => $verifCode]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $first_name, $last_name, $gender)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, gender = :gender WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
        ]);
    }

    public function updatePassword($oldPassword, $newPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password = :newPassword WHERE password = :oldPassword");
        return $stmt->execute([
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
        ]);
    }

    public function updateCode($email, $verifCode)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET verifCode = :verifCode WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'verifCode' => $verifCode,
        ]);
    }

    public function newEmail($email, $verifCode)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email = :email WHERE verifCode = :verifCode");
        return $stmt->execute([
            'email' => $email,
            'verifCode' => $verifCode,
        ]);
    }
    public function deleteCode($email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET verifCode = NULL WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
        ]);
    }
}