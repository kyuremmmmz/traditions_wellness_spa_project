<?php

namespace Project\App\Core\Middleware;

class SessionMiddleware
{
    public static function handle($request, $next)
    {
        session_start();

        $isAuthenticated = isset($_SESSION['user']);
        $currentRoute = $_SERVER['REQUEST_URI'];

        if ($isAuthenticated && in_array($currentRoute, ['/login', '/forgotpassword', '/register'])) {
            header('Location: /dashboard');
            exit;
        }

        if (!$isAuthenticated && in_array($currentRoute, ['/','/dashboard', '/profile', '/settings'])) {
            header('Location: /login');
            exit;
        }

        return $next($request);
    }

}
