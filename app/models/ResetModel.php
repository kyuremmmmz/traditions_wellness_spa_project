<?php
namespace VanillaBackend\App\Models;
use Project\App\Config\Connection;
use PDO;
class ResetModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo =  Connection::connection();
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

    public function insertTokenForPhone($phone)
    {
        $stmt = $this->pdo->prepare("INSERT INTO reset_phone_numbers_token (phone, token) VALUES (:phone, :token)");
        return $stmt->execute($phone);
    }

    public function update($token, $data, $number)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET phoone = :phone, column2 = :value2 WHERE token = :token AND phone = :phone");
        $data['token'] = $token;
        $data['phone'] = $number;
        return $stmt->execute($data);
    }


    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}