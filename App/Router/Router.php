<?php

namespace App\Router;

use App\Helpers\AuthenticatedUser;
use App\Helpers\general;
use App\Request\RequestReceived;
use Exception;

class Router

{
    use AuthenticatedUser;
    use general;
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
        return $this->match($requestUri, $requestMethod);
    }

    /**
     * @throws \Exception
     */
    //TODO ENABLE VOID FUNCTION
    public function match($requestUri, $requestMethod)
    {
        foreach ($this->routes->getRoutes() as $route) {


            if (preg_match("#^$route[url]$#", $requestUri)) {
                if (!in_array($requestMethod, $route['methods'])) {
                    throw new Exception('route not found');
                }

                if(!class_exists($route['controller'])){
                    throw new Exception('class does not exist');
                }

                if (!method_exists($route['controller'],$route['method'])){
                    throw new Exception('method does not exist');
                }
                if($route['auth']){
                    $this->isAuthUser($this->request->getAutCookie());
                }
                $data=['mar'=>2];
                $obj = new $route['controller']($data);
                $method=$route['method'];
                return $obj->$method();
            }
        }
        throw new Exception('service is not registerd');


    }



}