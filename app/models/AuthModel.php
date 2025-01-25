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