<?php

namespace App\controllers;

defined("ROOTPATH") or exit("access Denied");

use App\core\Validation;

class HomeController extends Controller
{
    private $str;
    use Validation;
    public function index()
    {
        // $model = new Model();
        $array = [
            'lastname' => 'bambino',
            "firstname" => "binjamin",
            "password" => "12345678",

        ];

        $this->renderView('home.php');
    }
}
