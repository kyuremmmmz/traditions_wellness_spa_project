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

    public function matchRoute()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {
                // Convert {parameter} syntax to regex pattern
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^/]+)', $routeUrl);
                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches
                    if (is_callable($target)) {
                        call_user_func_array($target, $params);
                    } elseif (is_string($target) && strpos($target, '@') !== false) {
                        list($controllerName, $methodName) = explode('@', $target);
                        $controllerClass = 'Project\\App\\Controllers\\' . $controllerName;
                        if (class_exists($controllerClass)) {
                            $controllerInstance = new $controllerClass();
                            if (method_exists($controllerInstance, $methodName)) {
                                call_user_func_array([$controllerInstance, $methodName], $params);
                            } else {
                                throw new Exception("Method $methodName not found in $controllerClass");
                            }
                        } else {
                            throw new Exception("Controller $controllerClass not found");
                        }
                    }
                    return;
                }
            }
        }

        throw new Exception('Route not found');
    }
}
