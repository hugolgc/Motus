<?php

declare(strict_types=1);

require_once '../routers/Router.php';

$classes = ['Memory', 'Letter', 'Player', 'Game'];
foreach ($classes as $class) {
    require_once "../class/$class.php";
}

$router = new Router();

$router->get('/', 'Home::lobby');
$router->post('/', 'home::createGame');

$router->get('/play', 'Play::index');
$router->post('/play', 'Play::submit');

$router->start();

//  php -S localhost:8000 -t public
