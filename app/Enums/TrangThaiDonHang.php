<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrangThaiDonHang extends Enum
{
    const DangChoXuLy = 0;
    const DangGiaoHang = 1;
    const HoanThanh = 2;
    const DaHuy = 3;
}
