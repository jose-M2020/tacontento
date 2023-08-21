<?php
namespace App\Routes;

// use App\Middleware\AuthMiddleware;
use App\Http\Kernel;
require_once 'app/config.php';

class Router
{
    private $routes = [];
    private $middlewares = [];
    private $routeMiddleware = [];
    private $groupMiddleware = [];
    private $currentRoute = null;
    private $isRouteGroup = false;

    public function middleware($middlewares)
    {
        if (!is_array($middlewares)) {
            $middlewares = [$middlewares];
        }
        
        foreach ($middlewares as $middlewareAlias) {
            $kernel = new Kernel();
            $middlewareClass = $kernel->getMiddlewareClass($middlewareAlias);
            
            if ($middlewareClass && class_exists($middlewareClass)) {
                $middlewareInstance = [new $middlewareClass()];
                // $this->middlewares[] = $middlewareInstance;
                
                // echo $this->isRouteGroup ? 'yes' : 'no';
                $this->middlewares = array_merge($this->groupMiddleware, $middlewareInstance);
                if(!$this->isRouteGroup) {
                } else {
                    // $this->groupMiddleware = $middlewareInstance;
                }
            }
        }
        
        if(!$this->isRouteGroup) {
        }
        $lastIndex = count($this->routes) - 1;
        $this->routes[$lastIndex]['middlewares'] = $this->middlewares;
        
        $this->middlewares = [];

        return $this;
    }

    public function get($route, $handler)
    {
        $this->addRoute('GET', $route, $handler);
        return $this;
    }

    public function post($route, $handler)
    {
        $this->addRoute('POST', $route, $handler);
        return $this;
    }

    public function put($route, $handler)
    {
        $this->addRoute('PUT', $route, $handler);
        return $this;
    }

    public function delete($route, $handler)
    {
        $this->addRoute('DELETE', $route, $handler);
        return $this;
    }

    public function group($callback)
    {
        // $this->groupMiddleware  = $middlewares;
        $this->isRouteGroup = true;
        $callback($this);
        $this->isRouteGroup = false;
        $this->groupMiddleware  = [];

        return $this;
    }

    // public function setRouteMiddleware($middlewares)
    // {
    //     $this->routeMiddleware = $middlewares;
    // }

    private function addRoute($method, $route, $handler)
    {
        $middlewares = array_merge($this->middlewares, $this->groupMiddleware);
        // $this->middleware($middlewares);
        // $this->routes[] = ['isGroup' => $this->isRouteGroup ? 'yes' : 'no'];

        $route = [
            'method' => $method,
            'route' => BASE_URL.$route,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
        
        // echo '<br /><pre>';
        // print_r($route);
        // echo '</pre> <br />';

        $this->routes[] = $route;
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $matchedRoute = null;
        
        echo '<pre>';
        print_r($this->routes);
        echo '</pre>';

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod) {
                $pattern = preg_replace('/:[^\/]+/', '([^/]+)', $route['route']);
                $pattern = str_replace('/', '\/', $pattern);

                // pattern to allow optional query parameters
                $pattern = '/^' . $pattern . '(?:\?.*)?$/';
                
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

            // foreach ($middlewares as $middleware) {
            //     if (!$middleware()) {
            //         echo "Middleware check failed. Access denied.";
            //         return;
            //     }
            // }
            $handlerInfo = explode('@', $matchedRoute['handler']);
            $controllerName = $handlerInfo[0];
            $method = $handlerInfo[1];
            $controllerClass = ucfirst($controllerName);
            $controllerFile = 'app/http/controller/' . $controllerClass . '.php';
            
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controller = new $controllerClass();
                $handlerMethod = $method;
                $params = $matchedRoute['params'] ?? [];
                
                // Call middlewares' handle method if implemented
                foreach ($middlewares as $middleware) {
                    if (method_exists($middleware, 'handle')) {
                        $middleware->handle($requestUri);
                    }
                }

                call_user_func([$controller, $handlerMethod], $params);
            } else {
                echo "Controller not found.";
            }
        } else {
            echo "Route not found.";
        }
    }
}
