<?php
namespace App\Utilities;
require_once 'app/config/config.php';

class Url {
  public function getFullRoute($route = '') {
    $protocol = $_SERVER['REQUEST_SCHEME'];
    $host = $_SERVER['HTTP_HOST'];

    return $protocol . '://' . $host . BASE_URL . $route;
  }

  function getUrlRoutes() {
    $requestUri = $_SERVER['REQUEST_URI'];
    // Use regular expression to remove the base URL from the beginning of the path
    $pattern = '~^' . preg_quote(BASE_URL, '~') . '~';
    $path = preg_replace($pattern, '', parse_url($requestUri, PHP_URL_PATH));
  
    // Explode the remaining path by '/'
    $pathSegments = explode('/', trim($path, '/'));
  
    // Filter out any empty segments
    $pathSegments = array_filter($pathSegments);
    
    return $pathSegments;
  }
}