<?php
namespace App\Facades;
use App\Routes\Router;

class Facade
{
    protected static $resolvedInstances = [];

    public static function __callStatic($method, $args)
    {
        $instance = static::resolveFacadeInstance();

        if (!method_exists($instance, $method)) {
            throw new \BadMethodCallException("Method $method does not exist on the resolved instance.");
        }

        return $instance->$method(...$args);
    }

    protected static function resolveFacadeInstance()
    {
        $facadeAccessor = static::getFacadeAccessor();

        if (!isset(static::$resolvedInstances[$facadeAccessor])) {
            static::$resolvedInstances[$facadeAccessor] = static::createResolvedInstance($facadeAccessor);
        }

        return static::$resolvedInstances[$facadeAccessor];
    }

    protected static function createResolvedInstance($facadeAccessor)
    {
        // Implement logic to create and return the appropriate instance
        // based on the $facadeAccessor.
        switch ($facadeAccessor) {
            case 'router':
                return new Router(); // Create a Router instance.
            case 'request':
                // return new Request(); // Create a Request instance.
            // Add more cases for other classes you want to resolve.
            default:
                throw new \RuntimeException("Facade accessor '$facadeAccessor' not supported.");
        }
    }

    protected static function getFacadeAccessor()
    {
        // This method should be implemented in subclasses to return
        // the appropriate key based on the desired class.
        return 'default'; // Placeholder value, to be customized in subclasses.
    }
}
