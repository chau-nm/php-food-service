<?php

namespace app\model\dto;

class OrderDetailDTO
{
    public function __construct(
        public string              $uuid,
        public FoodDTO             $food,
        public int                 $amount,
        public \DateTimeImmutable  $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    )
    {
    }
}