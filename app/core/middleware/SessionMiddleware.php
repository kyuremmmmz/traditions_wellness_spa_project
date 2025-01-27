<?php

namespace Project\App\Core\Middleware;

class SessionMiddleware
{
    public static function handle($request, $next)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return $next($request);
        }
        header('Location: /login');
        exit;
    }
}
