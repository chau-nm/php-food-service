<?php

namespace app\enum;

enum OrderStatus: string
{
    case DRAFT = 'draft';
    case SENDING = 'sending';
    case PAID = 'paid';
    case DELIVERED = 'delivered';
    case REJECTED = 'rejected';
}
