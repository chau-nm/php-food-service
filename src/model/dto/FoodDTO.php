<?php

namespace app\model\dto;

class FoodDTO
{
    public function __construct(
        public string $uuid,
        public string $name,
        public ?string $description,
        public string $image,
        public int  $price,
        public string $createdAt,
        public ?string $updatedAt,
        public ?UserDTO $createdBy,
        public ?UserDTO  $updatedBy
    )
    {
    }
}