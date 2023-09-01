<?php
namespace Core\Routing;

// use App\Middleware\AuthMiddleware;
use App\Http\Kernel;
require_once 'app/config/config.php';

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
            $middlewareInstance = $this->getMiddlewareInstance($middlewareAlias);

            if ($middlewareInstance) {
              $this->middlewares = array_merge(
                $this->middlewares,
                $middlewareInstance
              );
            }
        }
        
        $this->middlewares = array_merge($this->groupMiddleware, $this->middlewares);

        // if(!$this->isRouteGroup || !$isGroup) {
          $lastIndex = count($this->routes) - 1;
          $this->routes[$lastIndex]['middlewares'] = $this->middlewares;
        // }
        
        $this->middlewares = [];

        return $this;
    }

    private function getMiddlewareInstance($middlewareAlias) {
        $kernel = new Kernel();
        $middlewareClass = $kernel->getMiddlewareClass($middlewareAlias);
        
        return ($middlewareClass && class_exists($middlewareClass)) ? [new $middlewareClass()] : null;
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

    public function group($options, $callback)
    {
        $middlewares = isset($options['middleware']) ? $options['middleware'] : [];
        $prefix = isset($options['prefix']) ? $options['prefix'] : '';
        
        $this->setMiddlewareGroup($middlewares);

        $callback($this);
        $this->isRouteGroup = false;
        $this->groupMiddleware  = [];

        return $this;
    }

    // public function setRouteMiddleware($middlewares)
    // {
    //     $this->routeMiddleware = $middlewares;
    // }

    private function setMiddlewareGroup($middlewares)
    {
        if (!is_array($middlewares)) {
            $middlewares = [$middlewares];
        }
        
        foreach ($middlewares as $middlewareAlias) {
            $middlewareInstance = $this->getMiddlewareInstance($middlewareAlias);

            if ($middlewareInstance) {
              $this->groupMiddleware = array_merge(
                $this->groupMiddleware,
                $middlewareInstance,
              );
            }
        }
    }

    private function addRoute($method, $route, $handler)
    {
        $route = [
            'method' => $method,
            'route' => BASE_URL.$route,
            'handler' => $handler,
            'middlewares' => $this->groupMiddleware,
        ];

        $this->routes[] = $route;
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $matchedRoute = null;
        
        // Check if the _method parameter exists
        if (isset($_REQUEST['_method'])) {
          $requestMethod = strtoupper($_REQUEST['_method']);
        }
        
        // echo '<pre>';
        // print_r($this->routes);
        // echo '</pre>';

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
            $baseNamespace = 'App\\Http\\Controllers\\';

            $controllerClass = $baseNamespace . ucfirst($controllerName);
            
            if (class_exists($controllerClass)) {
                // require_once $controllerClass;
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
