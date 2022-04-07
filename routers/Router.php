<?php

class Router {
  private string $url;
  private string $method;
  private array $routes = [];

  public function __construct() {
    $this->url = $_SERVER['PATH_INFO'] ?? '/';
    $this->method = $_SERVER['REQUEST_METHOD'];
  }

  public function get(string $path, string $controller): void {
    $this->routes['GET'][$path] = $controller;
  }

  public function post(string $path, string $controller): void {
    $this->routes['POST'][$path] = $controller;
  }

  public function start(): void {
    if (!isset($this->routes[$this->method][$this->url])) {
      throw new RuntimeException('Aucune route correspondante');
    }
    
    $controller = explode('::', $this->routes[$this->method][$this->url]);

    require_once '../controllers/Controller.php';
    require_once '../controllers/' . $controller[0] . '.php';

    $action = new ReflectionMethod($controller[0], $controller[1]);
    $action->invokeArgs(new $controller[0], []);
  }
}