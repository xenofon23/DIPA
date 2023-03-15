<?php

namespace App\View;

use App\Database\database;
use App\Helpers\general;
use App\Helpers\headers;
use App\Routereee\Router;

class Page
{
    use headers;
    use general;
    use database;

    private Router $router;
    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function generatePage($page): string
    {
        $page = $this->router->GetRoute($page) ?: $this->router->GetRoute('index');
        $page['template']['{{data}}'] = $this->convertPageData($page);
        $bluePrint = $this->getContent('./View/Tpl/htmlBlueprint.tpl');
        $arrayTemplate = (array)$page['template'];
        return strtr($bluePrint, $arrayTemplate);
    }


    function viewPage($page)
    {
        echo $page;
    }


}