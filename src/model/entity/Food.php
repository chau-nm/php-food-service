<?php

namespace app\model\entity;

class Food
{
    public function __construct(
        public string  $uuid,
        public string  $name,
        public ?string $description,
        public string  $image,
        public int     $price,
        public string  $createdAt,
        public ?string $updatedAt,
        public ?string $createdBy,
        public ?string $updatedBy
    )
    {
    }
}