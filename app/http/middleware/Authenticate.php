<?php
namespace App\Http\Middleware;
require_once 'app/config/config.php';

class Authenticate
{
  public function handle($request)
  {
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario'])) {
        // Redirect or handle unauthorized user
        header('Location: '. BASE_URL .'/auth');
        return false;
    }

    return true;
  }
}
