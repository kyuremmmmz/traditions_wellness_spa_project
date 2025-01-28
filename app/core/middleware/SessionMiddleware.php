<?php

namespace Project\App\Core\Middleware;

class SessionMiddleware
{
    public static function handle($request, $next)
    {
        session_start();

        if (isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] !== '/dashboard') {
            header('Location: /dashboard');
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
        return $next($request);
    }
}
