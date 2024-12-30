<?php

namespace App\controllers;

defined("ROOTPATH") or exit("access Denied");

use App\core\Validation;
use App\model\UsersModel;

class UsersController extends Controller
{
    use Validation;
    public function login()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new UsersModel;
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);

            if ($row) {
                if ($row->password === $_POST['password']) {
                    $_SESSION['USER'] = $row;
                    header('Location: home/index');
                }
            }

            $user->errors['email'] = "Wrong email or password";

            $data['errors'] = $user->errors;
        }

        $this->renderView('login.php', $data);
    }

    public function register()
    {

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new UsersModel;
            if ($this->is_valid($_POST)) {
                $user->insert($_POST);
                header('Location: users/login');
            }

            $data['errors'] = $user->errors;
        }


        $this->renderView('register.php', $data);
    }
}
