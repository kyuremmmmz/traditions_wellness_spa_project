<?php 
namespace Project\App\Middleware;

class AuthMiddleware{
    // TODO: IMPLEMENT THE PROTECTED ROUTE
    public function handle($request) {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            echo json_encode(
                [
                    'message' => 'Unauthorized user'
                ]
            );
        }
    }
}