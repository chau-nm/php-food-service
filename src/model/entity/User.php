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
        public ?\DateTimeImmutable $updatedAt,
    )
    {
    }

//    public static fromQueryResult(array $result): static
//    {
//        return new self();
//    }
}