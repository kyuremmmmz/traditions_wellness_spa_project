<?php
namespace Project\App\Models\Utilities;

use PDO;
use Project\App\Config\Connection;

class AddOnsModel
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

    public function create($name, $price, $status)
    {
        $stmt = $this->pdo->prepare("INSERT INTO addontable (name, price, status) VALUES (:name, :price, :status)");
        return $stmt->execute([
            'name' => $name,
            'price' => $price,
            'status' => $status
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