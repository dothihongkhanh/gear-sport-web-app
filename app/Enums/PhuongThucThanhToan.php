<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PhuongThucThanhToan extends Enum
{
    const VNPay = 'VN Pay';
    const ThanhToanKhiNhanHang = 'Thanh toán khi nhận hàng';
}
