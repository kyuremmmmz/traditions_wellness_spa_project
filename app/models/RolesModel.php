<?php
namespace Project\App\Models;

use PDO;
use Project\App\Config\Connection;

class RolesModel
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

    public function findByEmail($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRoles($roleID, $name, $permissions)
    {
        $stmt = $this->pdo->prepare("INSERT INTO roles (roleID, name, permissions, created_at, updated_at) VALUES (:roleID, :name, :permissions, NOW(), NOW())");
        return $stmt->execute([
            'roleID' => $roleID,
            'name' => ucfirst(str_replace('_', '', $name)),
            'permissions' => json_encode(explode(',', $permissions)),
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