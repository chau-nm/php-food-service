<?php

namespace app\enum;

enum OrderStatus
{
    const DRAFT = 'draft';
    const SENDING = 'sending';
    const PAID = 'paid';
    const DELIVERED = 'delivered';
    const REJECTED = 'rejected';
}
