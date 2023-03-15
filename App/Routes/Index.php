<?php

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