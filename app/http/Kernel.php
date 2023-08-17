<?php

namespace App\Http;

class Kernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
      'auth' => \App\Http\Middleware\Authenticate::class
      // 'auth' => 'App\\Http\\Middleware\\'
    ];

    public function getMiddlewareClass($alias)
    {
      return $this->routeMiddleware[$alias] ?? null;
    }
}
