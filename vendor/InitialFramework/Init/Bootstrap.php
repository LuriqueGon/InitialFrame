<?php

namespace IF\Init;

abstract class Bootstrap
{
    private $routes;
    private $diretorio;

    public function __construct()
    {
        $this->diretorio = dir('../app/Routes/');   
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function __destruct()
    {
        $this->diretorio->close();
    }

    abstract protected function initRoutes():Void;

    protected function run($url)
    {
        foreach ($this->getRoutes() as $key => $route) {
            if(
                $url == $route['route']&& 
                $route['method'] == $_SERVER['REQUEST_METHOD'])
            {
                $class = "App\\Controllers\\". ucfirst($route['controller']);
                $controller = new $class();
                $action = $route['action'];
                $controller->$action();
                exit;
            }
        }

        require "../Config/Error/404/routes.php";

    }

    public function setRoutes(Array $routes):Void
    {
        $this->routes = $routes;
    }
    public function getRoutes():Array
    {
        return $this->routes;
    }
    
    protected function getUrl():String
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function loadAllRoutes($objectRoutes)
    {
        $allRoutes = $this->loadPath($objectRoutes);
        
        foreach($allRoutes as $formRoutes)foreach ($formRoutes as $key => $route) $objectRoutes[$key] = $route;
        return $objectRoutes;

    }

    private function loadPath($objectRoutes)
    {
        $allRoutes = [];
        while(($arquivo = $this->diretorio->read())) 
        {
            if($arquivo != '.' && $arquivo != '..'){
                array_push($allRoutes,$this->loadRoutes($this->getRouteName($arquivo), $objectRoutes));
            }
        }

        return $allRoutes;
    }

    private function loadRoutes($routePath, $objectRoutes)
    {
        $routePath = strtolower($routePath);
        
        if(file_exists("../app/Routes/$routePath.php"))return $this->loadRoute($routePath, $objectRoutes);
    }

    private function loadRoute($routePath, $objectRoutes)
    {
        require "../app/Routes/$routePath.php";
        foreach ($routes as $key => $route)$objectRoutes[$key] = $route;
        return $objectRoutes;
    }

    private function getRouteName($route):String{
        return str_replace('.php','',$route);
    }
}