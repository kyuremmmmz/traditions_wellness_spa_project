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
        $allowedRoutes = [
            '/login',
            '/forgotpassword',
            '/register',
            '/',
            '/users',
            '/notifications',
            '/Tracker',
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
        ];
        if ($isAuthenticated && $hasCookie && in_array($currentRoute, ['/login', '/forgotpassword', '/register', '/', '/Tracker'])) {
            header('Location: /dashboard');
            exit;
        }
        if (!in_array($currentRoute, $allowedRoutes)) {
            header('Location: /');
            exit;
        }
        if (!$isAuthenticated && !$hasCookie  &&
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
                '/changepassword',
                '/users'
            ])
        ) {
            header('Location: /login');
            exit;
        }

        return $next($request);
    }
}
