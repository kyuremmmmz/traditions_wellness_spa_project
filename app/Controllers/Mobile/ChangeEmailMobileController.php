<?php
namespace Project\App\Controllers\Mobile;

use PDO;
use Project\App\Config\Connection;

class ChangeEmailMobileController
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
        if (!isset($data['user_id'], $data['current_password'], $data['new_email'])) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required fields'
            ]);
            return;
        }

        try {
            // Validate email format
            if (!filter_var($data['new_email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email format');
            }

            // Get user's current data
            $stmt = $this->pdo->prepare("SELECT password, email FROM users WHERE id = :user_id");
            $stmt->execute(['user_id' => $data['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new \Exception('User not found');
            }

            // Verify current password
            if (!password_verify($data['current_password'], $user['password'])) {
                throw new \Exception('Current password is incorrect');
            }

            // Check if new email is different from current
            if ($user['email'] === $data['new_email']) {
                throw new \Exception('New email must be different from current email');
            }

            // Check if email already exists for another user
            $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :user_id");
            $stmt->execute([
                'email' => $data['new_email'],
                'user_id' => $data['user_id']
            ]);

            if ($stmt->fetch()) {
                throw new \Exception('Email already in use by another account');
            }

            // Update email
            $stmt = $this->pdo->prepare("UPDATE users SET email = :email, updated_at = NOW() WHERE id = :user_id");
            $stmt->execute([
                'user_id' => $data['user_id'],
                'email' => $data['new_email']
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Email updated successfully'
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