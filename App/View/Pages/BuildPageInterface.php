<?php

namespace App\View\Pages;

interface BuildPageInterface
{
    public function setHTML(string $html):void;
    public function setData(array $data):void;

    public function render():string;
}