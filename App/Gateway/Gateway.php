<?php

namespace App\Gateway;




use App\Router\Router;


class Gateway
{

    private Router $router;
    public function __construct(Router $router)
    {
        $this->router=$router;
    }

    /**
     * @throws \Exception
     */
    public function load(){
        //TODO MAINTENANCE AND OTHER CHECKS
       $this->router->matchCurrentRequest();
    }

}