<?php

namespace App\core;

defined("ROOTPATH") or exit("access Denied");


use PDO;
use PDOException;

class Db extends PDO
{
    private static $instance;
    private const DB_NAME = "mvc";
    private const DB_HOST = "localhost";
    private const DB_USER = "root";
    private const DB_PASS = "";

    public function __construct()
    {
        $dsn = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME;
        try {
            parent::__construct($dsn, self::DB_USER, self::DB_PASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
        } catch (PDOException $e) {
            die("erreur:" . $e->getMessage());
        }
    }

    public static function getInstance(): Db
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
