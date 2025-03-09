<?php
namespace Project\App\Models\Auth;

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

    public function login($phone)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->execute(['phone' => $phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($lastName, $firstName, $gender, $phone, $password, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (userID ,last_name, first_name, gender, phone, password,email, created_at, updated_at) VALUES (:userID,:lastname, :firstname, :gender, :phone, :password,:email, NOW(), NOW())");
        $user = random_int(100, 200);
        return $stmt->execute(
            [
                'userID' => $user,
                'lastname' => $lastName,
                'firstname' => $firstName,
                'gender' => $gender,
                'phone' => $phone,
                'password' => $password,
                'email' => $email
            ]
        );
    }

    public function verifCode($verifCode, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET verifCode = :verifCode, updated_at = NOW() WHERE email = :email");
        return $stmt->execute([
            'verifCode' => $verifCode,
            'email' => $email
        ]);
    }


    public function verifyEmail($verifCode)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email_verified_at = NOW(), updated_at = NOW() WHERE verifCode = :verifCode");
        return $stmt->execute([
            'verifCode' => $verifCode,
        ]);
    }

    public function updateVerifCodeTonull($email)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET verifCode = NULL, updated_at = NOW() WHERE email = :email");
        return $stmt->execute([
            'email' => $email
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}