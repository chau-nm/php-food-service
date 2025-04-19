<?php

namespace app\model\entity;

class Food
{
    public function __construct(
        public string              $uuid,
        public string              $name,
        public ?string             $description,
        public string              $image,
        public int                 $price,
        public \DateTimeImmutable  $createdAt,
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
            $queryResult['name'],
            $queryResult['description'],
            $queryResult['image'],
            $queryResult['price'],
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