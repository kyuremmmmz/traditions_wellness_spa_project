<?php
namespace Project\App\Controllers\Mobile;

use PDO;
use Project\App\Config\Connection;

class ChangePasswordMobileController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
        if ($this->pdo === null) {
            throw new \Exception("Failed to establish a database connection.");
        }
    }

    public function update()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate required fields
        if (!isset($data['user_id'], $data['current_password'], $data['new_password'])) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required fields'
            ]);
            return;
        }

        try {
            // Get user's current password hash
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = :user_id");
            $stmt->execute(['user_id' => $data['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new \Exception('User not found');
            }

            // Verify current password
            if (!password_verify($data['current_password'], $user['password'])) {
                throw new \Exception('Current password is incorrect');
            }

            // Validate new password
            if (strlen($data['new_password']) < 8) {
                throw new \Exception('New password must be at least 8 characters long');
            }

            // Hash new password
            $newPasswordHash = password_hash($data['new_password'], PASSWORD_DEFAULT);

            // Update password
            $stmt = $this->pdo->prepare("UPDATE users SET password = :password, updated_at = NOW() WHERE id = :user_id");
            $stmt->execute([
                'user_id' => $data['user_id'],
                'password' => $newPasswordHash
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Password updated successfully'
            ]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}