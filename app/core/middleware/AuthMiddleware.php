<?php

namespace Project\App\Core\Middleware;

class AuthMiddleware
{
    public static function handle($request, $next, $requiredRoles = ['Super Admin', 'Branch Admin'])
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if (in_array($user['role'], $requiredRoles)) {
                return $next($request);
            } else {
                http_response_code(403);
                header('Location:/login');
                exit;
            }
        }


        http_response_code(401);
        header('Location:/login');
        exit; 
    }
}
