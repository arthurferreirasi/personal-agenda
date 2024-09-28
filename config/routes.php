<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->connect('/', ['controller' => 'Events', 'action' => 'calendar']);
    $routes->connect('/calendar', ['controller' => 'Events', 'action' => 'calendar']);
    $routes->connect('/events/fetch', ['controller' => 'Events', 'action' => 'fetchEvents']);
    $routes->connect('/todo', ['controller' => 'Events', 'action' => 'todo']);
    $routes->connect('/notifications', ['controller' => 'Notifications', 'action' => 'index']);


    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        $builder->fallbacks();
    });

};
