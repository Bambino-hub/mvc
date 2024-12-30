<?php

namespace App\core;

defined("ROOTPATH") or exit("access Denied");


use App\controller\Controller;
use App\controllers\HomeController;

class Roote
{
    private function redirectUrl()
    {
        //we retrive url
        $url = $_SERVER['REQUEST_URI'];

        // if uri is not empty we trim /
        if (!empty($url)) {

            $url = trim($url, "/");
            http_response_code(301);
            header("Location:" . $url);
            exit;
        }
    }
    public function start()
    {
        // $this->redirectUrl();
        $uri = $_GET["url"] ?? 'home/index';
        if (!empty($uri)) {
            $uri = explode('/', $uri);
        }
        if ($uri[0] != '') {
            $controller = '\\App\\controllers\\' . ucfirst(array_shift($uri)) . 'Controller';
            //on instancie le contrôleur
            $controller = new $controller();
            // on repere le deuxieme u$urietre de l'url
            $action = (isset($uri[0])) ? array_shift($uri) : 'home';
            if (method_exists($controller, $action)) {
                // s'il reste des u$uriètre on les passe a la methode
                (isset($uri[0])) ? call_user_func_array([$controller, $action], $uri) : $controller->$action();
            } else {
                http_response_code(404);
                echo "La page rechercher n'existe pas";
            }
        }
    }
}
