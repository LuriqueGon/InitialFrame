<?php 

namespace App;
use IF\Init\Bootstrap;

Class Route extends Bootstrap
{
    
    protected function initRoutes():Void
    {
        $routes = array();
        $routes = $this->loadAllRoutes($routes);

        $this->setRoutes($routes);
        
    }
}

?>