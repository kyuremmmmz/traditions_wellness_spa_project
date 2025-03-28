<?php

namespace Project\App\Models\Utilities;

use PDO;
use Project\App\Config\Connection;

class NotificationsModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM notifications ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUserId($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($userId, $message, $type, $status)
    {
        $stmt = $this->pdo->prepare("INSERT INTO notifications (
        user_id,
        description,
        category,
        status
    ) VALUES (
        :user_id,
        :message,
        :category,
        :status
    )");

        return $stmt->execute([
            'user_id' => $userId,
            'message' => $message,
            'category' => $type,
            'status' => $status
        ]);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE notifications SET status = :status, updated_at = NOW() WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM notifications WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function getNotificationsByUser($userId)
{
    $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}