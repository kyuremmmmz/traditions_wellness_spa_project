<?php

namespace Project\App\Models\Utilities;

use Project\App\Config\Connection;

class NotificationsModel {
    private $db;

    public function __construct() {
        $this->db = Connection::connection();
    }

    public function getAllNotifications() {
        try {
            $query = "SELECT 
                        client_name,
                        email,
                        rating,
                        DATE_FORMAT(date_posted, '%Y-%m-%d') as date_posted
                      FROM notifications
                      ORDER BY date_posted DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error fetching notifications: " . $e->getMessage());
            return [];
        }
    }
}