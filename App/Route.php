<?php 

namespace App;

Class Route
{
    private $routes;
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    protected function run($url)
    {

        foreach ($this->getRoutes() as $key => $route) {
            if(
                $route['route'] == $url && 
                $route['method'] == $_SERVER['REQUEST_METHOD'])
            {
                $class = "App\\Controllers\\". ucfirst($route['controller']);
                $controller = new $class();
                $action = $route['action'];
                $controller->$action();
                exit;
            }
        }

        require "../Config/Error/404.php";

    }

    protected function setRoutes(Array $routes):Void
    {
        $this->routes = $routes;
    }
    public function getRoutes():Array
    {
        return $this->routes;
    }
    
    protected function initRoutes():Void
    {
        $routes['home'] = array(
            'route' => '/',
            'method' => 'GET',
            'controller' => 'IndexController',
            'action' => 'index'
        );

        $routes['homePOST'] = array(
            'route' => '/',
            'method' => 'POST',
            'controller' => 'IndexController',
            'action' => 'formIndex'
        );

        $this->setRoutes($routes);
        
    }
    protected function getUrl():String
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}

?>