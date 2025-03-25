<?php

class NotificationsController {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Create a new notification
    public function createNotification($user_id, $type, $message, $data = null) {
        $query = "INSERT INTO notifications (user_id, type, message, data, is_read, created_at) VALUES (?, ?, ?, ?, 0, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id, $type, $message, json_encode($data)]);
    }
    
    // Get all notifications for a user
    public function getNotifications($user_id, $limit = 10) {
        $query = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$user_id, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Mark a notification as read
    public function markAsRead($notification_id) {
        $query = "UPDATE notifications SET is_read = 1 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$notification_id]);
    }
    
    // Delete a notification
    public function deleteNotification($notification_id) {
        $query = "DELETE FROM notifications WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$notification_id]);
    }
}
