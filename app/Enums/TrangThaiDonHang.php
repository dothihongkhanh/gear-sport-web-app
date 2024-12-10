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
    const DangChoXuLy = 'Đang chờ xử lý';
    const DangGiaoHang = 'Đang giao hàng';
    const HoanThanh = 'Hoàn thành';
    const DaHuy = 'Đã hủy';

    public static function all(): array
    {
        return [
            self::DangChoXuLy,
            self::DangGiaoHang,
            self::HoanThanh,
            self::DaHuy,
        ];
    }
}
