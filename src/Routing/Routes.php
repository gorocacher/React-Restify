<?php

namespace CapMousse\ReactRestify\Routing;

use CapMousse\ReactRestify\Evenement\EventEmitter;

class Routes extends EventEmitter
{
    private $router;
    private $prefix;

    /**
     * Create a new group of routes
     * 
     * @param  \CapMousse\ReactRestify\Routing\Router $router
     * @param  String                                 $prefix   
     * @param  Function                               $callback
     */
    public function __construct($router, $prefix)
    {
        $this->router = $router;
        $this->prefix = $prefix;
    }

    /**
     * Add a post route
     *
     * @param string $route
     * @param mixed  $callback
     *
     * @return \CapMousse\ReactRestify\Routing\Route
     */
    public function post($route, $callback)
    {
        $route = $this->router->addRoute("POST", $this->prefix . '/' . $route, $callback);
        $route->onAny(function($event, $arguments){
            $this->emit($event, $arguments);
        });

        return $route;
    }

    /**
     * Add a get route
     *
     * @param string $route
     * @param mixed  $callback
     *
     * @return \CapMousse\ReactRestify\Routing\Route
     */
    public function get($route, $callback)
    {
        $route = $this->router->addRoute("GET", $this->prefix . '/' . $route, $callback);
        $route->onAny(function($event, $arguments){
            $this->emit($event, $arguments);
        });

        return $route;
    }

    /**
     * Add a del route
     *
     * @param string $route
     * @param mixed  $callback
     *
     * @return \CapMousse\ReactRestify\Routing\Route
     */
    public function delete($route, $callback)
    {
        $route = $this->router->addRoute("DELETE", $this->prefix . '/' . $route, $callback);
        $route->onAny(function($event, $arguments){
            $this->emit($event, $arguments);
        });

        return $route;
    }

    /**
     * Add a put route
     *
     * @param string $route
     * @param mixed  $callback
     *
     * @return \CapMousse\ReactRestify\Routing\Route
     */
    public function put($route, $callback)
    {
        $route = $this->router->addRoute("PUT", $this->prefix . '/' . $route, $callback);
        $route->onAny(function($event, $arguments){
            $this->emit($event, $arguments);
        });

        return $route;
    }

    /**
     * Add a new group of routes
     * @param  string   $prefix 
     * @param  callback $callback
     *
     * return \CapMousse\ReactRestify\Routing\Routes
     */
    public function group($prefix, $callback)
    {
        $group = $this->router->addGroup($this->prefix . '/' . $prefix, $callback);

        $group->onAny(function($event, $arguments){
            $this->emit($event, $arguments);
        });
    }


    /**
     * Helper to listing to after event
     * 
     * @param  [type] $callback [description]
     * @return [type]           [description]
     */
    public function after($callback)
    {
        $this->on('after', $callback);
    }
}