<?php

namespace Api;

class Application
{

    /**
     * @var Database
     */
    public $db;

    /**
     * @var Router
     */
    public $router;

    /**
     * @var string
     */
    public $basePath;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {

        if (array_key_exists('db', $config)) {
            list('dsn' => $dsn, 'username' => $username, 'password' => $password) = $config['db'];
            $this->db = new Database($dsn, $username, $password);
        }

        $this->router = new Router();
    }

    public function run()
    {
        $this->router->routeMath($_SERVER['REQUEST_URI']);
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        if ($this->basePath === null) {
            $this->basePath = getcwd();
        }
        return $this->basePath;
    }
    /**
     * @param  string|null  $path
     * @return string
     */
    public function getStaticPath($path = null)
    {
        return $this->getBasePath().'/static'.($path ? '/'.$path : $path);
    }
}
