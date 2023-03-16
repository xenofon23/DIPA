<?php

namespace App\Gateway;




use App\Helpers\general;
use App\Request\RequestReceived;
use App\Router\Router;
use App\View\Page;
use Exception;


class Gateway
{

    use general;
    private Router $router;
    private RequestReceived $request;
    public function __construct(Router $router,RequestReceived $request)
    {
        $this->request=$request;
        $this->router=$router;
    }

    /**
     * @throws \Exception
     */
    public function load(){
        //TODO MAINTENANCE AND OTHER CHECKS
        return ($this->request->getMethod()==='GET')?
        $this->checkForPage():
       $this->router->matchCurrentRequest();
    }

    /**
     * @throws Exception
     */
    private function checkForPage(): string
    {
        echo $this->request->getUri();
        if($this->checkHtml($this->request->getUri())){
            $page=new Page();
            return $page->generatePage($this->request->getUri());
        }
        throw new Exception('page does not and in .html');
}

}