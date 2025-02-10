<?php

namespace Project\App\Core\Middleware;

use Project\App\Controllers\Mobile\AuthMobileController;

class MobileMiddleware
{
    public static function handle()
    {
        $mobileController = new AuthMobileController();
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No token provided']);
            exit();
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $userData = $mobileController->verifyJWT($token);

        if (!$userData) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid or expired token']);
            exit();
        }

        return $userData['data'];
    }
}
