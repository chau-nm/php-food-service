<?php

namespace app\model\entity;

class Order
{
    public function __construct(
        public int                $id,
        public string             $userUuid,
        public string        $status,
        public string             $address,
        public string             $phone,
        public \DateTimeImmutable $orderDate,
        public \DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
        public ?string             $createdBy,
        public ?string             $updatedBy
    )
    {
    }

    public static function fromQueryResult(array $queryResult): static
    {
        return new static(
            $queryResult['id'],
            $queryResult['user_uuid'],
            $queryResult['status'],
            $queryResult['address'],
            $queryResult['phone'],
            isset($queryResult['order_date']) ? new \DateTimeImmutable($queryResult['order_date']) : null,
            isset($queryResult['created_at']) ? new \DateTimeImmutable($queryResult['created_at']) : null,
            isset($queryResult['updated_at']) ? new \DateTimeImmutable($queryResult['updated_at']) : null,
            $queryResult['created_by'],
            $queryResult['updated_by'],
        );
    }

    public static function fromQueryArrayResult(array $queryArrayResult): array
    {
        return array_map(fn($row) => static::fromQueryResult($row), $queryArrayResult);
    }
}