<?php
namespace Project\App\Models\Services;

use PDO;
use Project\App\Config\Connection;

class ServicesModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllServiceName()
    {
        $stmt = $this->pdo->query("SELECT id,serviceName, price, description FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createCategory($category)
    {
        $stmt = $this->pdo->prepare("INSERT INTO services (category, updated_at, created_at) VALUES (:categoryNameField, NOW(), NOW())");
        return $stmt->execute([
            'categoryNameField' => $category
        ]);
    }

    public function update($id, $description, $price, $serviceName)
    {
        $stmt = $this->pdo->prepare("UPDATE services SET description = :description, price = :price, serviceName = :serviceName WHERE category = :radio");
        return $stmt->execute([
            'radio' => $id,
            'description' => $description,
            'price' => $price,
            'serviceName' => $serviceName
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}