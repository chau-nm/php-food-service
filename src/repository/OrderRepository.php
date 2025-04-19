<?php

namespace app\repository;

use app\conf\Database;
use app\model\entity\Order;

class OrderRepository implements RepositoryInterface
{

    private static $instance;
    private \PDO $db;

    private const FULL_ATTRIBUTES = "
                `id`,
                `user_uuid`,
                `status`,
                `address`,
                `phone`,
                `order_date`,
                `created_at`,
                `updated_at`,
                `created_by`,
                `updated_by`
    ";

    private const TABLE_NAME = "`order`";

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

    public function findByKey(int|string $key): ?Order
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME . " WHERE `id` = ?";
        $prepare = $this->db->prepare($query);
        $prepare->execute([$key]);
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        return $result ? Order::fromQueryResult($result) : null;
    }

    public function findAll(): array
    {
        $query = "SELECT " . self::FULL_ATTRIBUTES . " FROM " . self::TABLE_NAME;
        $prepare = $this->db->prepare($query);
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return Order::fromQueryArrayResult($result);
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

        return Order::fromQueryArrayResult($results);
    }

    public function save(mixed $entity): mixed
    {
        $stmt = $this->db->prepare("SELECT COUNT(`id`) FROM " . self::TABLE_NAME . " WHERE id = :id");
        $stmt->execute(['id' => $entity->id]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            $sql = "
                UPDATE " . self::TABLE_NAME . " SET
                    user_uuid = :user_uuid,
                    status = :status,
                    address = :address,
                    phone = :phone,
                    order_date = :order_date,
                    updated_at = :updated_at,
                    updated_by = :updated_by
                WHERE id = :id
            ";
        } else {
            $sql = "
                INSERT INTO " . self::TABLE_NAME . " (
                    id, user_uuid, status, address, phone, order_date, created_at, updated_at, created_by, updated_by
                ) VALUES (
                    :id, :user_uuid, :status, :address, :phone, :order_date, :created_at, :updated_at, :created_by, :updated_by
                )
            ";
        }

        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute([
            'id' => $entity->id,
            'user_uuid' => $entity->userUuid,
            'status' => $entity->status->value,
            'address' => $entity->address,
            'phone' => $entity->phone,
            'order_date' => $entity->orderDate->format('Y-m-d H:i:s'),
            'created_at' => $entity->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $entity->updatedAt ? $entity->updatedAt->format('Y-m-d H:i:s') : null,
            'created_by' => $entity->createdBy,
            'updated_by' => $entity->updatedBy
        ]);

        return $result ? $entity : null;
    }
    
    public function deleteByKey(string $key): int
    {
        $stmt = $this->db->prepare("DELETE FROM " . self::TABLE_NAME . " WHERE id = :id");
        $stmt->execute(['id' => $key]);
        return $stmt->rowCount();
    }
}