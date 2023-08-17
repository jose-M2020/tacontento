<?php
namespace App\Http\Middleware;
require_once 'app/config.php';

class Authenticate
{
  public function handle($request)
  {
      if (!isset($_SESSION['cliente'])) {
          // Redirect or handle unauthorized user
          header('Location: '. BASE_URL .'/auth');
          exit;
      }
  }

  public static function checkAuthenticated()
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            return false;
        }
        
        return true;
    }
}
