<?php

namespace app\conf;

use PDO;

class Database
{
    private static $instance;
    private PDO $pdo;

    private function __construct() {
        $dbConfig = require __DIR__ . "/database/connection.php";
        $this->pdo = new PDO($dbConfig["dsn"], $dbConfig["username"], $dbConfig["password"]);
    }

    public static function connection(): PDO {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
