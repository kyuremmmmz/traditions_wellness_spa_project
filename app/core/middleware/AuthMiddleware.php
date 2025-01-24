<?php 
namespace Project\App\Middleware;

use Composer\DependencyResolver\Request;

class AuthMiddleware
{
    // TODO: IMPLEMENT THE PROTECTED ROUTE
    public function __invoke($request, $next)
    {
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