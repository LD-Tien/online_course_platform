<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ReactionType extends Enum
{
    const DISLIKE = 0;
    const LIKE = 1;
}
