<?php

namespace app\model\entity;

class User
{
    public function __construct(
        public string              $uuid,
        public string              $username,
        public string              $hashPassword,
        public string              $email,
        public string              $firstName,
        public string              $lastName,
        public string              $phone,
        public string              $address,
        public ?string             $avatar,
        public \DateTimeImmutable  $createdAt,
        public ?\DateTimeImmutable $updatedAt
    )
    {
    }

    public static function fromQueryResult(array $queryResult): static
    {
        return new static(
            $queryResult['uuid'],
            $queryResult['username'],
            $queryResult['hash_password'],
            $queryResult['email'],
            $queryResult['first_name'],
            $queryResult['last_name'],
            $queryResult['phone'],
            $queryResult['address'],
            $queryResult['avatar'],
            isset($queryResult['created_at']) ? new \DateTimeImmutable($queryResult['created_at']) : null,
            isset($queryResult['updated_at']) ? new \DateTimeImmutable($queryResult['updated_at']) : null
        );
    }

    public static function fromQueryArrayResult(array $queryArrayResult): array
    {
        return array_map(fn($row) => static::fromQueryResult($row), $queryArrayResult);
    }
}