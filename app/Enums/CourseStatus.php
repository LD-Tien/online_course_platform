<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CourseStatus extends Enum
{
    const DRAFT = 1;
    const UNDER_REVIEW = 2;
    const PUBLISHED = 3;
    const UNPUBLISHED = 4;
    const REJECTED = 5;
}
