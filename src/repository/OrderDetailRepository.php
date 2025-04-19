<?php

namespace app\repository;

use app\conf\Database;
use app\model\entity\OrderDetail;

class OrderDetailRepository implements RepositoryInterface
{

    private static $instance;
    private \PDO $db;

    private const FULL_ATTRIBUTES = "
            `uuid`,
            `order_id`,
            `food_uuid`,
            `amount`,
            `created_at`,
            `updated_at`,
            `created_by`,
            `updated_by`
    ";

    private const TABLE_NAME = "`order_detail`";

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

    public function findByKey(int|string $key): mixed
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME . " WHERE `uuid` = ?";
        $prepare = $this->db->prepare($query);
        $prepare->execute([$key]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        return $result ? OrderDetail::fromQueryResult($result) : null;
    }

    public function findAll(): array
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME;
        $prepare = $this->db->prepare($query);
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return OrderDetail::fromQueryArrayResult($result);
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

        return OrderDetail::fromQueryArrayResult($results);
    }

    public function save(mixed $entity): mixed
    {
        $stmt = $this->db->prepare("SELECT COUNT(`uuid`) FROM food WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $entity->uuid]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $sql = "
            UPDATE " . self::TABLE_NAME . " SET
                name = :name,
                description = :description,
                image = :image,
                price = :price,
                updated_at = :updated_at,
                updated_by = :updated_by
            WHERE uuid = :uuid
        ";
        } else {
            $sql = "
            INSERT INTO " . self::TABLE_NAME . " (
                uuid, name, description, image, price, created_at, updated_at, created_by, updated_by
            ) VALUES (
                :uuid, :name, :description, :image, :price, :created_at, :updated_at, :created_by, :updated_by
            )
        ";
        }

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            'uuid' => $entity->uuid,
            'name' => $entity->name,
            'description' => $entity->description,
            'image' => $entity->image,
            'price' => $entity->price,
            'created_at' => $entity->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $entity->updatedAt ? $entity->updatedAt->format('Y-m-d H:i:s') : null,
            'created_by' => $entity->createdBy,
            'updated_by' => $entity->updatedBy
        ]);

        return $result ? $entity : null;
    }

    public function deleteByKey(string $key): int
    {
        $stmt = $this->db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE uuid = :uuid");
        $stmt->execute(['uuid' => $key]);
        return $stmt->rowCount();
    }
}