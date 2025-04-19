<?php

namespace app\model\dto;

use app\enum\OrderStatus;

class OrderDTO
{
    public function __construct(
        public int                $id,
        public UserDTO            $user,
        public OrderStatus        $status,
        public string             $address,
        public string             $phone,
        public array              $items,
        public \DateTimeImmutable $orderDate,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
    )
    {
    }
}