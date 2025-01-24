<?php 
namespace Project\App\Core\Middleware;
class AuthMiddleware
{
    public static function handle($request, $next, $requiredRoles = ['users', 'therapist', 'super admin', 'assistant admin'])
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            echo json_encode(
                [
                    'Error' => 'Unauthorized user'
                ]
            );
        }
        return $next($request);
    }
}