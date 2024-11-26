<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Quyen extends Enum
{
    const QuanTriVien = 0;
    const KhachHang = 1;
}
