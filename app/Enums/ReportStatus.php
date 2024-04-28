<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ReportStatus extends Enum
{
    const PENDING = 1;
    const PROCESSED = 2;
    const REJECTED = 3;
}
