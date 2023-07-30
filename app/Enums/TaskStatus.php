<?php declare(strict_types=1);

namespace App\Enums;

use Illuminate\Validation\Rules\Enum as RulesEnum;

/**
 * @method static static DONELATE()
 * @method static static TODO()
 * @method static static DOING()
 * @method static static REVIEWING()
 * @method static static DONE()
 */
final class TaskStatus extends RulesEnum
{
    const DONELATE = -1;
    const TODO = 0;
    const DOING = 1;
    const REVIEWING = 2;
    const DONE = 3;
}
