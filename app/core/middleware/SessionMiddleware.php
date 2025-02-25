<?php

namespace Project\App\Core\Middleware;

class SessionMiddleware
{
    public static function handle($request, $next)
    {
        session_start();

        $isAuthenticated = isset($_SESSION['user']);
        $hasCookie = isset($_COOKIE['user']);
        $currentRoute = $_SERVER['REQUEST_URI'];

        if ($isAuthenticated && $hasCookie && in_array($currentRoute, ['/login', '/forgotpassword', '/register'])) {
            header('Location: /dashboard');
            exit;
        }

        if (
            !$isAuthenticated && !$hasCookie  &&
            in_array($currentRoute, [
                '/',
                '/dashboard',
                '/profile',
                '/settings',
                '/services',
                '/employees',
                '/appointments',
                '/finances',
                '/inventory',
                '/account',
                '/changephonenumber',
                '/verificationforchangephonenumber',
                '/changepassword'
            ])
        ) {
            header('Location: /login');
            exit;
        }

        return $next($request);
    }
}
