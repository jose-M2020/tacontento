<?php
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
                
                // Handle query parameters
                $query = parse_url($requestUri, PHP_URL_QUERY);
                parse_str($query, $queryParams);
                $params = array_merge($params, $queryParams);

                $route['params'] = $params;
                $matchedRoute = $route;
                break;
            }
        }
    }
    
    if ($matchedRoute) {
        $handlerInfo = explode('@', $matchedRoute['handler']);
        $controllerName = $handlerInfo[0];
        $method = $handlerInfo[1];
        
        $controllerClass = ucfirst($controllerName) . 'Controller';
        $controllerInstance = new $controllerClass();
        
        $controllerInstance->$method($matchedRoute['params']);
    } else {
        echo "Route not found.";
    }
}

?>