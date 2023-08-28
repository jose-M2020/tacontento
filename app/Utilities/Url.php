<?php
namespace App\Utilities;
require_once 'app/config/config.php';

class Url {
  public function getFullRoute($route = '') {
    $protocol = $_SERVER['REQUEST_SCHEME'];
    $host = $_SERVER['HTTP_HOST'];

    return $protocol . '://' . $host . BASE_URL . $route;
  }
}