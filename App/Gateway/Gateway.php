<?php

namespace App\Gateway;



use App\Helpers\general;
use App\View\Page;
use App\Request\RequestReceived;
use App\Routereee\Router;
use App\Controllers\ViewController;


class Gateway
{

    private RequestReceived $request;
    public function __construct()
    {
//        $this->router=new Router();
//        $this->page=new Page($this->router);
        $this->request=new RequestReceived();
//        $this->viewcontroller=new ViewController($this->page,$this->request);
    }

    public function load(){
//        $this->checkMaintenanceMode();
//        $this->viewcontroller->isPage();
    }

}