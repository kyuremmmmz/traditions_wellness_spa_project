<?php

namespace App\Core;

use Exception;

class Router
{
    private $routes = [];

    public function get($path, $controller, $middleware = null)
    {
        $this->routes['GET'][$path] = compact('controller', 'middleware');
    }

    public function post($path, $controller, $middleware = null)
    {
        $this->routes['POST'][$path] = compact('controller', 'middleware');
    }

    public function put($path, $controller, $middleware = null)
    {
        $this->routes['PUT'][$path] = compact('controller', 'middleware');
    }

    public function delete($path, $controller, $middleware = null)
    {
        $this->routes['DELETE'][$path] = compact('controller', 'middleware');
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $route => $config) {
            if (preg_match($this->convertToRegex($route), $path, $params)) {
                $controller = $config['controller'];
                $middleware = $config['middleware'];
                list($controllerName, $action) = explode('@', $controller);
                $controllerClass = "Project\\App\\Controllers\\$controllerName";
                require_once "../app/Controllers/$controllerName.php";
                if ($middleware) {
                    $middlewareClass = "Project\\App\\Core\\Middleware\\$middleware";
                    require_once "C:/xampp/htdocs/TraditionsWellnessSpa/Project/app/core/middleware/$middleware.php";
                    $middlewareInstance = new $middlewareClass();
                    $middlewareResult = $middlewareInstance::handle($_REQUEST, function () use ($controllerClass, $action, $params) {
                        $controllerInstance = new $controllerClass();
                        return $controllerInstance->$action(array_slice($params, 1));
                    });
                    return $middlewareResult;
                }
                $controllerInstance = new $controllerClass();
                return $controllerInstance->$action(array_slice($params, 1));
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    private function convertToRegex($route)
    {
        $escapedRoute = preg_replace('/\//', '\/', $route);
        return '/^' . str_replace(['{id}'], ['(\d+)'], $escapedRoute) . '$/';
    }
}
