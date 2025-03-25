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

    public function view($path, $viewFile, $foldername, $middleware = null)
    {
        $this->routes['GET'][$path] = compact('viewFile', 'middleware', 'foldername');
    }

    public function resolve()
    {
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $isApiRequest = false;
            
            // Check if this is an API request (mobile or AJAX)
            if (strpos($path, '/mobile') === 0 || 
                (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
                json_decode(file_get_contents('php://input'), true)) {
                $isApiRequest = true;
            }

            foreach ($this->routes[$method] ?? [] as $route => $config) {
                if (preg_match($this->convertToRegex($route), $path, $params)) {
                    if (isset($config['viewFile'])) {
                        if (isset($config['middleware'])) {
                            $middlewareClass = "Project\\App\\Core\\Middleware\\{$config['middleware']}";
                            $middleware = new $middlewareClass();
                            $middleware::handle($_REQUEST, function () use ($config) {
                                $this->renderView($config['foldername'], $config['viewFile']);
                            });
                            return;
                        }
                        $this->renderView($config['foldername'], $config['viewFile']);
                        return;
                    }

                    $controller = $config['controller'] ?? null;
                    if ($controller) {
                        $middleware = $config['middleware'] ?? null;
                        list($controllerName, $action) = explode('@', $controller);

                        if (strpos($controllerName, 'Mobile\\') === 0) {
                            $controllerName = substr($controllerName, strlen('Mobile\\'));
                            $controllerNamespace = "Project\\App\\Controllers\\Mobile\\";
                            $isApiRequest = true;
                        } else {
                            $controllerNamespace = json_decode(file_get_contents('php://input'), true) ? "Project\\App\\Controllers\\Mobile\\" : "Project\\App\\Controllers\\Web\\UseCases\\";
                            if (json_decode(file_get_contents('php://input'), true)) {
                                $isApiRequest = true;
                            }
                        }
                        $controllerClass = $controllerNamespace . $controllerName;
                        $controllerInstance = new $controllerClass();

                        if ($middleware) {
                            $middlewareClass = "Project\\App\\Core\\Middleware\\$middleware";
                            $middlewareInstance = new $middlewareClass();
                            $middlewareInstance::handle($_REQUEST, function () use ($controllerInstance, $action, $params) {
                                $controllerInstance->$action(array_slice($params, 1));
                            });
                        } else {
                            $controllerInstance->$action(array_slice($params, 1));
                        }
                        return;
                    }
                }
            }
            
            // If we get here, no route was matched
            if ($isApiRequest) {
                // For API requests, return JSON error
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Route not found']);
                return;
            }
            
            // For regular web requests, redirect to home
            http_response_code(404);
            header('Location:/');
        } catch (\Exception $e) {
            // Handle exceptions
            if ($isApiRequest ?? false) {
                // For API requests, return JSON error
                http_response_code(500);
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            } else {
                // For regular web requests, redirect to home with error
                http_response_code(500);
                header('Location:/');
            }
        }

        http_response_code(404);
        header('Location:/');
    }

    private function renderView($foldername, $viewFile)
    {
        $viewPath = dirname(__DIR__) . "/views/php/pages/$foldername/$viewFile.php";
        if (file_exists($viewPath)) {
            ob_start();
            include $viewPath;
            $content = ob_get_clean();
            include dirname(__DIR__) . "/views/index.php";
        } else {
            throw new Exception("View file not found: $viewPath");
        }
    }

    private function convertToRegex($route)
    {
        $escapedRoute = preg_replace('/\//', '\\/', $route);
        return '/^' . str_replace(['{id}'], ['(\\d+)'], $escapedRoute) . '$/';
    }

    private function isMobileRequest()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return preg_match('/(android|iphone|ipad|ipod|mobile)/i', $userAgent);
    }
}
