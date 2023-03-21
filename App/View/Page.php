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



    public function generatePage($page): string
    {
        $page =json_decode(json_encode($this->isRegisteredPage($page),true),true);

        if ($page===null){
            $this->generatePage('404.html');
        }
        $page['template']['{{data}}'] =  json_encode($page['template']['{{data}}'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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




}