<?php

namespace app\repository;

use app\conf\Database;
use app\model\entity\Order;
use app\model\entity\User;
use PDO;

class UserRepository
{
    private static $instance;
    private \PDO $db;

    private const FULL_ATTRIBUTES = "`uuid`, 
                `username`, 
                `hash_password`, 
                `fist_name`, 
                `last_name`, 
                `email`, 
                `address`, 
                `phone`,
                `avatar`,
                `created_at`,
                `updated_at`";

    private function __construct()
    {
        $this->db = Database::connection();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function findByUuid(string $uuid): ?User
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM `user` WHERE `uuid` = ?";
        $prepare = $this->db->prepare($query);
        $prepare->execute([$uuid]);
        $result = $prepare->fetch();
        return null;
    }
}