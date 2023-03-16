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

    public function loadRoutesFromJson(): void
    {
        $routes =json_decode(file_get_contents('../App/Router/routes.json'),true);

        foreach ($routes as $route) {
            $this->addRoute($route['url'], $route['controller'], $route['methods']);
        }
    }
}