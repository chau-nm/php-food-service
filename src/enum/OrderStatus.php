<?php

namespace app\enum;

enum OrderStatus: string
{
    const DRAFT = 'draft';
    const SENDING = 'sending';
    const PAID = 'paid';
    const DELIVERED = 'delivered';
    const REJECTED = 'rejected';
}
