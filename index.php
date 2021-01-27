<?php
require __DIR__ . '/vendor/autoload.php';

use Php7Scafold\Core\Router;
use Php7Scafold\Controller\UserController;

$router = new Router($_SERVER);

$router->addRoute('/', 'GET', function () {
    require __DIR__ . '/home.html';
});

$router->addRoute('/login', 'POST', function () {
    $user = new UserController($this->method, $this->params, $this->body);
    $user->login();
});

$router->addRoute('/users', 'GET', function () {
    $user = new UserController($this->method, $this->params, $this->body);
    $user->find();
});

$router->addRoute('/users/:id', 'GET', function () {
    $user = new UserController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->findById();
});

$router->addRoute('/users/:id', 'PUT', function () {
    $user = new UserController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->update();
});

$router->addRoute('/users/:id', 'DELETE', function () {
    $user = new UserController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->delete();
});

$router->run();
