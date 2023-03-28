<?php

namespace App\Controllers;

use App\Helpers\general;
use App\View\Page;
use App\Request\RequestReceived;

class ViewController
{
    use general;

    private Page $page;
    private RequestReceived $requestreceived;

    public function __construct(Page $page, RequestReceived $requestreceived)
    {
        $this->requestreceived = $requestreceived;
        $this->page = $page;
    }

    public function render($pageName)
    {
        $generatedPage = $this->page->generatePage($pageName);
        $this->page->viewPage($generatedPage);
    }

    public function isPage()
    {
        if ($this->checkHtml($this->requestreceived->getUri())) {
            $this->render('index');
        }
    }

}