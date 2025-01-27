<?php
namespace Project\App\Models;
use PDO;
use Project\App\Config\Connection;

use function Symfony\Component\Clock\now;

class AuthModel
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

    public function find($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(
        string $lastName,
        string $firstName,
        string $email,
        string $password,
        string $phone,
        string $branch,
        string $dateOfRegistration,
        string $role,
        string $username,
        ?string $emailVerifiedAt = null,
        ?string $startDate = null,
        ?string $rememberToken = null
    ): bool {
        $stmt = $this->pdo->prepare("INSERT INTO users 
        (
        userID,
        last_name, 
        first_name,
        email, 
        email_verified_at, 
        password, 
        phone, 
        branch, 
        date_of_registration, 
        start_date, 
        role,
        username, 
        remember_token, 
        created_at, 
        updated_at) 
        VALUES 
        (
        :userID,
        :last_name, 
        :first_name, 
        :email, 
        :email_verified_at, 
        :password, 
        :phone, 
        :branch, 
        :date_of_registration, 
        :start_date, 
        :role,
        :username, 
        :remember_token, 
        :created_at, 
        :updated_at)
    ");

        $currentTimestamp = date('Y-m-d H:i:s');
        $user = random_int(100, 200);
        return $stmt->execute([
            'userID' => $user,
            'last_name' => $lastName,
            'first_name' => $firstName,
            'email' => $email,
            'email_verified_at' => $emailVerifiedAt,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'phone' => $phone,
            'branch' => $branch,
            'date_of_registration' => $dateOfRegistration,
            'start_date' => $startDate,
            'role' => $role,
            'username' => $username,
            'remember_token' => $rememberToken,
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);
    }


    public function update($email,$data)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET email_verified_at = :email_verified_at WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'email_verified_at' => $data
        ]);
    }

    public function forgotPassword($data, $newPassword, $uName)
    {
        $stmt = $this->pdo->prepare("UPDATE users 
        SET password = :newPassword, remember_token = :remember_token 
        WHERE username = :username");
        return $stmt->execute([
            'newPassword' => $newPassword,
            'remember_token' => $data,
            'username' => $uName
        ]);
    }

    public function insertToken($token,$email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO password_reset_tokens (email, token, created_at) VALUES(:email, :token, :created_at)");
        return $stmt->execute([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}