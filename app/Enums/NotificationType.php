<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class NotificationType extends Enum
{
    const ORDER_STATUS = 1;
    const ORDER_ITEM_STATUS = 2;
    const REPORT_STATUS = 3;
    const COURSE_STATUS = 4;
}
