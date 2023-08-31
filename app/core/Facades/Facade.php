<?php
namespace Core\Facades;
use Core\Routing\Router;
use Core\Http\Request;

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
        switch ($facadeAccessor) {
            case 'router':
                return new Router();
            case 'request':
                return new Request();
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
