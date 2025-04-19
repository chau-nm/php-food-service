<?php

namespace app\model\entity;

use app\enum\OrderStatus;

class Order
{
    public function __construct(
        public int                $id,
        public string             $userUuid,
        public OrderStatus        $status,
        public string             $address,
        public string             $phone,
        public \DateTimeImmutable $orderDate,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
        public string             $createdBy,
        public string             $updatedBy
    )
    {
    }
}