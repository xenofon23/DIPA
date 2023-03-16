<?php

namespace App\View;

use App\Database\database;
use App\Helpers\general;
use App\Helpers\headers;
use App\Router\Router;


class Page
{
    use headers;
    use general;
    use database;

    private Router $router;
    /**
     * @param Router $router
     */
    public function __construct()
    {
    }

    public function generatePage($page): string
    {
        $page =$this->isRegisteredPage($page);

        if ($page===null){
            $this->generatePage('index.html');
        }
        $page['template']['{{data}}'] = $this->convertPageData($page);
        $bluePrint = file_get_contents('../App/View/Tpl/htmlBlueprint.tpl');
        $arrayTemplate = (array)$page['template'];
        return strtr($bluePrint, $arrayTemplate);
    }

    public function isRegisteredPage($pageName): object|array|null
    {
        $collection = $this->mongo('pages');
        $match = [
            'name' => $pageName
        ];

       return $collection->findOne($match, []);
    }

        function viewPage($page)
    {
        echo $page;
    }


}