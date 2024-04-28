<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderItemStatus extends Enum
{
    const PAID = 1;
    const REFUND_PENDING = 2;
    const REFUNDED = 3;
}
