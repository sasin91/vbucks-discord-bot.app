<?php

namespace App\Enums;

enum OrderStatus: string
{
    case NEW = 'new';
    case PAID = 'paid';
    case ASSIGNED = 'assigned';
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';
}
