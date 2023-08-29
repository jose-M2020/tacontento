<?php
namespace Core\Facades;

class Route extends Facade
{
    public static function getFacadeAccessor()
    {
        // Return the key that corresponds to your request instance in the container.
        return 'request';
    }
}
