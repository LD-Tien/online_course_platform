<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ReportType extends Enum
{
    const COURSE = 1;
    const LESSON = 2;
    const QUIZ = 3;
    const POST = 4;
    const COMMENT = 5;
    const REVIEW = 6;
}
