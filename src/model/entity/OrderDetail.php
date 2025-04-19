<?php

namespace app\model\entity;

class OrderDetail
{
    public function __construct(
        public string             $uuid,
        public int                $orderId,
        public string             $foodUuid,
        public int                $amount,
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
            $queryResult['uuid'],
            $queryResult['order_id'],
            $queryResult['food_uuid'],
            $queryResult['amount'],
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