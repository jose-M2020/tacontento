<?php
class Router
{
    private $routes = [];
    private $globalMiddleware = [];
    private $routeMiddleware = [];
    private $groupMiddleware = [];

    public function middleware($middleware)
    {
        $this->globalMiddleware[] = $middleware;
        return $this;
    }

    public function get($route, $handler, $middlewares = [])
    {
        $this->addRoute('GET', $route, $handler, $middlewares);
        return $this;
    }

    public function post($route, $handler, $middlewares = [])
    {
        $this->addRoute('POST', $route, $handler, $middlewares);
        return $this;
    }

    public function put($route, $handler, $middlewares = [])
    {
        $this->addRoute('PUT', $route, $handler, $middlewares);
        return $this;
    }

    public function delete($route, $handler, $middlewares = [])
    {
        $this->addRoute('DELETE', $route, $handler, $middlewares);
        return $this;
    }

    public function group($middlewares, $callback)
    {
        $this->groupMiddleware  = $middlewares;
        $callback($this);
        $this->groupMiddleware  = [];
    }

    public function setRouteMiddleware($middlewares)
    {
        $this->routeMiddleware = $middlewares;
    }

    private function addRoute($method, $route, $handler, $middlewares)
    {
        $middlewares = array_merge($this->globalMiddleware, $middlewares, $this->routeMiddleware);
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
        $this->routeMiddleware = [];
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        
        $matchedRoute = null;
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod) {
                $pattern = preg_replace('/:[^\/]+/', '([^/]+)', $route['route']);
                $pattern = str_replace('/', '\/', $pattern);
                $pattern = '/^' . $pattern . '$/';

                if (preg_match($pattern, $requestUri, $matches)) {
                    array_shift($matches);
                    $params = [];
                    preg_match_all('/:[^\/]+/', $route['route'], $paramNames);
                    $paramNames = array_map(function ($param) {
                        return substr($param, 1);
                    }, $paramNames[0]);
                    foreach ($paramNames as $index => $name) {
                        $params[$name] = $matches[$index];
                    }
                    $route['params'] = $params;
                    $matchedRoute = $route;
                    break;
                }
            }
        }

        if ($matchedRoute) {
            $middlewares = $matchedRoute['middlewares'];
            foreach ($middlewares as $middleware) {
                if (!$middleware()) {
                    echo "Middleware check failed. Access denied.";
                    return;
                }
            }
            $handler = $matchedRoute['handler'];
            $params = $matchedRoute['params'] ?? [];
            call_user_func($handler, $params);
        } else {
            echo "Route not found.";
        }
    }
}
