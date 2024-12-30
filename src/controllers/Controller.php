<?php

namespace App\controllers;

defined("ROOTPATH") or exit("access Denied");


abstract class Controller
{
    public function renderView(string $viewPath, $parameters = [])
    {
        if (is_array($parameters)) {
            // we extract data
            extract($parameters);
        }
        if (is_string($viewPath)) {
            require_once ROOT_VIEW . $viewPath;
        }
    }
}
