<?php
namespace Project\App\Models\Auth;


use PDO;
use Project\App\Config\Connection;

class ResetTokensModel
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

    public function upsert($phone, $data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO phone_reset_tokens (token, phone) VALUES (:token, :phone)");
        $stmt->execute([
            'phone' => $phone,
            'token' => $data['token']
        ]);
        $update = $this->pdo->prepare("UPDATE users SET phone_tokens = :phone_tokens, phone = :phone WHERE phone_tokens = :phone_tokens AND phone=:phone");
        $update->execute([
            'phone' => $phone,
            'phone_tokens' => $data['token']
        ]);
        return true;
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