<?php

namespace Project\App\Core\Middleware;

class CorsMiddleware
{
    public static function handle($request, $next)
    {
        // Clean any existing output buffers to prevent HTML in JSON responses
        if (ob_get_level()) {
            ob_clean();
        }
        
        // Set CORS headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 3600');

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }

        // Continue with the request
        $next();
    }
}