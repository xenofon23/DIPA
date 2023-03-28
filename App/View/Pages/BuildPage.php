<?php

namespace App\View\Pages;

class BuildPage implements BuildPageInterface
{
    private string $html;
    private  array $data;

    public function setHTML(string $html): void
    {
        $this->html=$html;
    }

    public function setData(array $data): void
    {
        $this->data=$data;
    }

    public function render():String{
        return strtr($this->html, $this->data);
    }
}