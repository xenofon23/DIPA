<?php

namespace App\View;

use App\Database\database;
use App\Helpers\general;
use App\Helpers\headers;
use App\Router\Router;
use App\View\Pages\BuildPage;


class Page
{
    use headers;
    use general;
    use database;




    public function generatePage($page,array $vars=null): string
    {
        $buildPage=new BuildPage();
        $page =json_decode(json_encode($this->isRegisteredPage($page),true),true);
        if ($page===null){
            $this->generatePage('/search.html');
        }
        if (isset($page['dynamicData'])) {
            $page['template']['{{data}}']['dynamicData'] = $this->callProcess($page['dynamicData']['class'],$page['dynamicData']['function'],$vars);
        }
        $page['template']['{{data}}'] =  json_encode($page['template']['{{data}}'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $bluePrint = file_get_contents('../App/View/Tpl/htmlBlueprint.tpl');
        $buildPage->setHTML($bluePrint);
        $arrayTemplate = (array)$page['template'];
        $buildPage->setData($arrayTemplate);
        return $buildPage->render();

    }
    //TODO IF I ' M NOT BORED I CAN ADD ROUTES FOR PROCESS IN PAGE
    public function callProcess($class,$function,$vars){
        $obj=new $class();
        return $obj->$function();
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