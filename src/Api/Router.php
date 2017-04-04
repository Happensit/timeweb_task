<?php

namespace Api;

/**
 * Class Router
 * @package Api
 */
class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->add($path, $callback);
    }

    /**
     * @param $path
     * @param $callback
     */
    private function add($path, $callback)
    {
        $pattern = sprintf("/^%s$/i", str_replace('/', '\/', $path));

        $this->routes[$pattern] = $callback;
    }


    /**
     * @param null $url
     * @return mixed
     * @throws \Exception
     */
    public function routeMath($url = null)
    {
        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $url, $params)) {
                $params = array_slice($params, 1);
                return call_user_func_array($callback, $params);
            }
        }

        throw new \Exception("Route not found");
    }
}