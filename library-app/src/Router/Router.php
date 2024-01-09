<?php

namespace Router;

use Http;

class Router implements RouterInterface
{
    private $routes = [];

    public function addRoute($method, $path, $callback)
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'callback' => $callback];
    }

    public function dispatch()
    {
        $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
        $currentPath = rtrim($currentPath, '/');
        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $request = new Http\Request();
        $response = new Http\Response();

        foreach ($this->routes as $route) {
            $pattern = preg_replace_callback('/\{([^\/]+)\}/', function ($matches) {
                $parts = explode(':', $matches[1]);
                $paramName = $parts[0];
                $paramPattern = isset($parts[1]) ? '(' . $parts[1] . ')' : '([^\/]+)';
                return '(?P<' . $paramName . '>' . $paramPattern . ')';
            }, $route['path']);


            if ($route['method'] === $currentMethod && preg_match('#^' . $pattern . '$#', $currentPath, $matches)) {
                $params = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));
                $request->setUriParams($params);
                $parts = explode('::', $route['callback']);

                if (count($parts) === 2) {
                    $className = $parts[0];
                    $method = $parts[1];

                    if (class_exists($className) && method_exists($className, $method)) {
                        call_user_func_array([$className, $method], array_merge([$request, $response], array_values($params)));
                        return;
                    }
                }
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
    }
}
