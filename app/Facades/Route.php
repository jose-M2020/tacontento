<?php
namespace App\Facades;

class Route extends Facade
{
    public static function getFacadeAccessor()
    {
        // Return the key that corresponds to your router instance in the container.
        return 'router';
    }
}
