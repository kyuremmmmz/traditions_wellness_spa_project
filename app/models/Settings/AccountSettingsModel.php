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
}