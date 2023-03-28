<?php

namespace App\Router;

use App\Request\RequestReceived;
use Exception;

class Router

{
    protected Routes $routes;
    private RequestReceived $request;
    public function __construct(RequestReceived $request,Routes $routes)
    {
        $this->request=$request;
        $this->routes = $routes;
    }


    /**
     * @throws Exception
     */
    public function matchCurrentRequest()
    {
        $requestMethod = $this->request->getMethod();
        $requestUri =  $this->request->getUri();

        print_r($requestUri);
        return $this->match($requestUri, $requestMethod);
    }

    /**
     * @throws \Exception
     */
    //TODO ENABLE VOID FUNCTION
    public function match($requestUri, $requestMethod)
    {
        foreach ($this->routes->getRoutes() as $route) {
            if (!in_array($requestMethod, $route['methods'])) {
               throw new Exception('route not found');
            }

            if (preg_match("#^$route[url]$#", $requestUri)) {
                if(!class_exists($route['controller'])){
                    throw new Exception('class does not exist');
                }
                $controller = new $route['controller']();
                if (!method_exists($route['controller'],$route['method'])){
                    throw new Exception('method does not exist');
                }
                return $controller->$route['method']($this->request->getMessage());
            }
        }
        throw new Exception('service is not registerd');


    }



}