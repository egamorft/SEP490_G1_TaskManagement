<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DONELATE()
 * @method static static TODO()
 * @method static static DOING()
 * @method static static REVIEWING()
 * @method static static DONE()
 */
final class TaskStatus extends Enum
{
    const DONELATE = -1;
    const TODO = 0;
    const DOING = 1;
    const REVIEWING = 2;
    const DONE = 3;
}