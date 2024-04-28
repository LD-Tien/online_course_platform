<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RefundRequestStatus extends Enum
{
    const PENDING = 1;
    const ACCEPTED = 2;
    const REJECTED = 3;
}
