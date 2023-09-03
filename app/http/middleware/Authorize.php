<?php
namespace App\Http\Middleware;
require_once 'app/config/config.php';

class Authorize
{
  public function handle($request)
  {
    $role = $_SESSION['usuario']['role'] ?? null;

    if ($role && in_array($role, $request)) {
      return true;
    }
    
    return false;
  }
}
