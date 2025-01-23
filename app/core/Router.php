<?php

namespace App\Core;

use Exception;

class Router
{
    private $routes = [];

    public function get($path, $controller)
    {
        $this->routes['GET'][$path] = $controller;
    }

    public function post($path, $controller)
    {
        $this->routes['POST'][$path] = $controller;
    }

    public function put($path, $controller)
    {
        $this->routes['PUT'][$path] = $controller;
    }

    public function delete($path, $controller)
    {
        $this->routes['DELETE'][$path] = $controller;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $route => $controller) {
            if (preg_match($this->convertToRegex($route), $path, $params)) {
                list($controllerName, $action) = explode('@', $controller);
                $controllerClass = "Project\\App\\Controllers\\$controllerName";
                require_once "../app/Controllers/$controllerName.php";
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
