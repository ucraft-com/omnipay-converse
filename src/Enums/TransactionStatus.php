<?php

declare(strict_types=1);

namespace Omnipay\Converse\Enums;

enum TransactionStatus: string
{
    case PAID = '2';
    case FAILED = '6';
    case CANCELED = '3';
    case REFUND = '4';
}
