<?php

namespace App\Router;

class Routes
{
    protected array $routes = [];

    public function addRoute($url, $controller, $methods)
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'methods' => $methods,
        ];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function loadRoutesFromYaml($file)
    {
        $routes = yaml_parse_file($file);

        foreach ($routes as $route) {
            $this->addRoute($route['url'], $route['controller'], $route['methods']);
        }
        print_r($routes);
    }
}