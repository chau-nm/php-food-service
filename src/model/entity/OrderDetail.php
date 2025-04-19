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
}