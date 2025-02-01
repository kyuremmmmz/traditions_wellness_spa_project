<?php
namespace Project\App\Models;
use Project\App\Config\Connection;
use PDO;
class PhotoUpdloadModel
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

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO your_table_name (column1, column2) VALUES (:value1, :value2)");
        return $stmt->execute($data);
    }

    public function update($email, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET photos = :photos WHERE email = :email");
        return $stmt->execute([
            'email' => $email,
            'photos' => $data
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}