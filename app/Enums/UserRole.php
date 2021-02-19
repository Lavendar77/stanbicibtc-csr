<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static ProgramCoordinator()
 * @method static static Student()
 */
final class UserRole extends Enum
{
    public const ADMIN = 'admin';
    public const PROGRAMCOORDINATOR = 'program coordinator';
    public const STUDENT = 'student';
}
