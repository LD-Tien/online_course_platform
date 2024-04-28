<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class QuizStatus extends Enum
{
    const DRAFT = 1;
    const UNDER_REVIEW = 2;
    const PUBLISHED = 3;
    const UNPUBLISHED = 4;
    const REJECTED = 5;
}
