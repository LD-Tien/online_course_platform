<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRole extends Enum
{
    const ADMIN = 1;
    const MODERATOR = 2;
    const INSTRUCTOR = 3;
    const LEANER = 4;
}
