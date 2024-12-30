<?php

use App\core\Roote;

session_start();

// valid PHP version
$minPHPVersion = '8.0';
if (phpversion() < $minPHPVersion) {
    die("Your PHP version must be $minPHPVersion or higter to run this app.Your current version is" . phpversion());
}
// we require the autoload of composer
require_once dirname(__DIR__) . "/vendor/autoload.php";

// I declare const
define('ROOT_VIEW', dirname(__DIR__) . '/src/views/');
define('ROOT', 'http://localhost/testmvc/public');
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

$root = new Roote();
$root->start();
