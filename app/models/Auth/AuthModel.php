<?php
namespace Project\App\Models\Auth;
use PDO;
use Project\App\Config\Connection;
use Project\App\Entities\PrivateFunctions;


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

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByCode($code)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE verifCode = :verifCode");
        $stmt->execute(['verifCode' => $code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function findByToken($token)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE remember_token = :remember_token");
        $stmt->execute(['remember_token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByPhone($phone) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->execute(['phone' => $phone]);
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
        ?string $photos = null,
        ?string $startDate = null,
        ?string $rememberToken = null,
        ?string $emailVerifiedAt = null,
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
        isFirstTimeLogin ,
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
        1,
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

    public function forgotPassword($data, $newPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE users 
        SET password = :newPassword, remember_token = :remember_token 
        WHERE remember_token = :remember_token");
        return $stmt->execute([
            'newPassword' => $newPassword,
            'remember_token' => $data,
        ]);
    }

    public function insertToken($token,$email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO password_reset_tokens (email, token, created_at) VALUES(:email, :token, :created_at)");
        $update = $this->pdo->prepare("UPDATE users SET remember_token = :remember_token WHERE email = :email");
        $stmt->execute([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $update->execute([
            'email' => $email,
            'remember_token' => $token
        ]);
        return true;
    }

    public function delete($email)
    {
        $stmt = $this->pdo->prepare("DELETE FROM password_reset_tokens WHERE email = :email");
        return $stmt->execute(['email' => $email]);
    }
    
}