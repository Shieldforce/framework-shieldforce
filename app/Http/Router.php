<?php

namespace App\Http;

use Closure;
use Exception;
use ReflectionFunction;

class Router
{
    /**
     * URL complete is project
     * @var string
     */
    private $url = '';

    /**
     * URL prefix is project
     * @var string
     */
    private $prefix = '';

    /**
     * Index Routes
     * @var array
     */
    private $routes = [];

    /**
     * Request Instance
     * @var Request
     */
    private $request;

    /**
     * Method responsable for init class
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Method responsable capture prefix is URL
     * @return void
     */
    private function setPrefix()
    {
        // Information the URL currency
        $parseUrl = parse_url($this->url);

        // Define prefix
        $this->prefix = $parseUrl["path"] ?? '';
    }

    /**
     * Method responsable for add a route in Class
     * @param string $method
     * @param string $route
     * @param array $params
     * @return void
     */
    private function addRoute($method, $route, $params = [])
    {
        // Validation the params
        foreach ($params as $key => $value) {
            if($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Variables is route
        $params['variables'] = [];

        // Pattern of validation the variables the routes
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        // Pattern is validation URL
        $patternRoute = '/^'.str_replace('/','\/', $route).'$/';

        // Add is route
        $this->routes[$patternRoute][$method] = $params;

    }

    /**
     * Method responsable for define route GET
     * @param string $route
     * @param array $params
     * @return void
     */
    public function get(string $route, $params = [])
    {
        $this->addRoute("GET", $route, $params);
    }

    /**
     * Method responsable for define route POST
     * @param string $route
     * @param array $params
     * @return void
     */
    public function post(string $route, $params = [])
    {
        $this->addRoute("POST", $route, $params);
    }

    /**
     * Method responsable for define route PUT
     * @param string $route
     * @param array $params
     * @return void
     */
    public function put(string $route, $params = [])
    {
        $this->addRoute("PUT", $route, $params);
    }

    /**
     * Method responsable for define route DELETE
     * @param string $route
     * @param array $params
     * @return void
     */
    public function delete(string $route, $params = [])
    {
        $this->addRoute("DELETE", $route, $params);
    }

    /**
     * Method responsable for return data of route
     * @return string
     */
    private function getUri()
    {
        // Remove prefix
        $uri = $this->request->getUri();

        // Beech URI
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // Return end index is URI
        return end($xUri);
    }

    /**
     * Method responsable for return data of route
     * @return array
     */
    private function getRoute()
    {
        // Uri
        $uri = $this->getUri();

        // Method
        $httpMethod = $this->request->getHttpMethod();

        // Validation url

        foreach ($this->routes as $patternRoute=>$methods) {

            if(preg_match($patternRoute, $uri, $matches)) {

                // Verify is method
                if(isset($methods[$httpMethod])) {

                    // Remove first position
                    unset($matches[0]);

                    // Variables processed
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    // Return the params the route
                    return $methods[$httpMethod];
                }
                throw new Exception("Method not permission", 405);
            }
        }
        throw new Exception("Url not found", 404);
    }

    /**
     * Method responsable for execute route currency
     * @return Response
     */
    public function run()
    {

        // get route currency
        $route = $this->getRoute();

        // Verify controller
        if(!isset($route['controller'])) {
            throw new Exception("Url cannot be processed", 500);
        }

        // Arguments of function
        $args = [];

        // Reflection
        $reflection = new ReflectionFunction($route['controller']);
        foreach ($reflection->getParameters() as $parameter) {
            $name = $parameter->getName();
            $args[$name] = $route['variables'][$name] ?? '';
        }

        // Return execute controller
        return call_user_func_array($route['controller'], $args);

    }

}