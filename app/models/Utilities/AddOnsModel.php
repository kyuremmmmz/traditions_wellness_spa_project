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
        $stmt = $this->pdo->query("SELECT *, CASE WHEN status = 'Archived' THEN true ELSE false END as is_archived FROM addontable");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM addontable WHERE id = :id");
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

    public function update($id, $name, $price, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE addontable SET name = :name, price = :price, status = :status WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'status' => $status
        ]);
    }

    public function delete($addon_id)
    {
        $query = "DELETE FROM addontable WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$addon_id]);
    }
}