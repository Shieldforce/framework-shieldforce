<?php

namespace App\Http\Middleware;

use App\Http\Request\Request;
use App\Http\Response;
use Exception;

class QueueMiddleware
{

    /**
     * Mapping middleware
     * @var array
     */
    private static $map = [];

    /**
     * Mapping middlewares default
     * @var array
     */
    private static $default = [];

    /**
     * Queue of middlewares
     * @var array
     */
    private $middlewares = [];

    /**
     * Function of execution of controller
     * @var Closure
     */
    private $controller;

    /**
     * Args of controller
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Init class
     * @param $middlewares
     * @param $controller
     * @param $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Responsable for defined the mapping the middlewares
     * @param $map
     * @return void
     */
    public static function setMap($map)
    {
        self::$map = $map;
    }

    /**
     * Responsable for defined the mapping the middlewares
     * @param $map
     * @return void
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }

    /**
     * Method responsable for executed the next level
     * @param Request
     * @return Response
     */
    public function next($request)
    {
        // Verify is queue is null
        if(empty($this->middlewares)) {
            return call_user_func_array($this->controller, $this->controllerArgs);
        }

        // Verify middleware
        $middleware = array_shift($this->middlewares);

        // Verify mapping
        if(!isset(self::$map[$middleware])) {
            throw new Exception("Error in execution is middleware", 500);
        }

        // Next
        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };

        // Execute othe middleware
        return (new self::$map[$middleware])->handle($request, $next);

    }
}