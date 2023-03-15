<?php

namespace App\Router;

use App\Request\RequestReceived;

class Router

{
    protected Routes $routes;
    private RequestReceived $request;
    public function __construct(RequestReceived $request,Routes $routes)
    {
        $this->request=$request;
        $this->routes = $routes;
    }



    public function matchCurrentRequest()
    {
        $requestMethod = $this->request->getMethod();
        $requestUri =  $this->request->getUri();

        print_r($requestUri);
        return $this->match($requestUri, $requestMethod);
    }

    public function match($requestUri, $requestMethod)
    {
        foreach ($this->routes->getRoutes() as $route) {
            if (!in_array($requestMethod, $route['methods'])) {
                continue;
            }

            if (preg_match("#^$route[url]$#", $requestUri, $matches)) {
                $controller = new $route['controller']();
                $controller->$route['method']();
                return true;
            }
        }

        return false;
    }



}