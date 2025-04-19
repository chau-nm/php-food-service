<?php

namespace app\repository;

use app\conf\Database;
use app\model\entity\User;

class UserRepository implements RepositoryInterface
{
    private static $instance;
    private \PDO $db;

    private const FULL_ATTRIBUTES = "
                `uuid`, 
                `username`, 
                `hash_password`, 
                `first_name`, 
                `last_name`, 
                `email`, 
                `address`, 
                `phone`,
                `avatar`,
                `created_at`,
                `updated_at`
    ";

    private const TABLE_NAME = "`user`";

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

    public function findByKey(string|int $key): ?User
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME . " WHERE `uuid` = ?";
        $prepare = $this->db->prepare($query);
        $prepare->execute([$key]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        return $result ? User::fromQueryResult($result) : null;
    }

    public function findAll(): array
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME;
        $prepare = $this->db->prepare($query);
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return User::fromQueryArrayResult($result);
    }

    public function findBy(array $where): array
    {
        $sql = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME;

        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $column => $value) {
                $conditions[] = "`$column` = :$column";
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => User::fromQueryResult($row), $results);
    }

    public function save(mixed $entity): ?User
    {
        $stmt = $this->db->prepare("SELECT COUNT(`uuid`) FROM " . self::TABLE_NAME . " WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $entity->uuid]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $sql = "
                UPDATE " . self::TABLE_NAME . " SET
                    username = :username,
                    hash_password = :hash_password,
                    email = :email,
                    first_name = :first_name,
                    last_name = :last_name,
                    phone = :phone,
                    address = :address,
                    avatar = :avatar,
                    updated_at = :updated_at
                WHERE uuid = :uuid
            ";
        } else {
            $sql = "
                INSERT INTO " . self::TABLE_NAME . " (
                    uuid, username, hash_password, email,
                    first_name, last_name, phone, address,
                    avatar, created_at, updated_at
                ) VALUES (
                    :uuid, :username, :hash_password, :email,
                    :first_name, :last_name, :phone, :address,
                    :avatar, :created_at, :updated_at
                )
            ";
        }

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            'uuid' => $entity->uuid,
            'username' => $entity->username,
            'hash_password' => $entity->hashPassword,
            'email' => $entity->email,
            'first_name' => $entity->firstName,
            'last_name' => $entity->lastName,
            'phone' => $entity->phone,
            'address' => $entity->address,
            'avatar' => $entity->avatar,
            'created_at' => $entity->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
        ]);

        return $result ? $entity : null;
    }

    public function delete(mixed $entity): int
    {
        $uuid = $entity->uuid;
        $stmt = $this->db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $uuid]);
        return $stmt->rowCount();
    }

    public function deleteByKey(string $key): int
    {
        $stmt = $this->db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $key]);
        return $stmt->rowCount();
    }
}