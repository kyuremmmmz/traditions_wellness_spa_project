<?php

namespace App\Core;

use Exception;

class Router
{
    private $routes = [];

    public function get($path, $controller, $middleware = [])
    {
        $this->routes['GET'][$path] = compact('controller', 'middleware');
    }

    public function post($path, $controller, $middleware = [])
    {
        $this->routes['POST'][$path] = compact('controller', 'middleware');
    }

    public function put($path, $controller, $middleware = [])
    {
        $this->routes['PUT'][$path] = compact('controller', 'middleware');
    }

    public function delete($path, $controller, $middleware = [])
    {
        $this->routes['DELETE'][$path] = compact('controller', 'middleware');
    }

    public function view($path, $viewFile, $foldername, $middleware = [])
    {
        $this->routes['GET'][$path] = compact('viewFile', 'middleware', 'foldername');
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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

                    $controllerNamespace = json_decode(file_get_contents('php://input'), true) ? "Project\\App\\Controllers\\Mobile\\" : "Project\\App\\Controllers\\Web\\UseCases\\";
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
