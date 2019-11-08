<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Draft()
 * @method static static Scheduled()
 * @method static static Published()
 * @method static static Archived()
 */
final class PostEnumStatusType extends Enum
{
    const Draft = 0;
    const Scheduled = 1;
    const Published = 2;
    const Archived = 3;
}
