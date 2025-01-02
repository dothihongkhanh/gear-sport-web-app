<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('san_pham')->insert([
            [
                'ma_danh_muc' => 2,
                'ma_thuong_hieu' => 1,
                'ten_san_pham' => 'Thảm Tập Yoga Định Tuyến Cao Cấp 2 Lớp Loại 1 Chống Trượt',
                'mo_ta' => 'Thảm tập được sản xuât từ 100% chất liệu TPE tinh khiết từ cao su tự nhiên, không mùi, không sử dụng phụ gia, hóa chất nên tuyệt đối an toàn kể cả cho trẻ nhỏ và phụ nữ mang thai. Thảm tập yoga có chất liệu từ cao su tự nhiên. Thảm có đường định tuyến giúp người tập xác định rõ phương hướng dễ dàng hơn trong quá trình tập luyện',
                'hinh_anh' => '/storage/sanpham/thamyoga.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_danh_muc' => 1,
                'ma_thuong_hieu' => 2,
                'ten_san_pham' => 'Dây Nhảy Thể Dục  Với Lõi Thép Đàn Hồi Chịu Trọng Lượng',
                'mo_ta' => '- Dây nhảy được làm từ chất liệu cao cấp có độ bền rất cao, không bị đứt và có khả năng co giãn rất tốt. Phần tay cầm của dây nhảy được làm từ nhựa cứng PP khá bền bỉ và được bọc mút để chống trơn trượt trong quá trình sử dụng kể nhất là đối với những người hay bị ra mồ hôi tay.
 - Tay cầm của dây nhảy được thiết kế để có thể thêm tạ giúp độ nặng thích hợp và dễ sử dụng hơn.',
                'hinh_anh' => '/storage/sanpham/daynhay.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_danh_muc' => 1,
                'ma_thuong_hieu' => 1,
                'ten_san_pham' => 'Dây kéo tập cơ bụng 4 ống',
                'mo_ta' => 'Đặc điểm nổi bật:
- Chất liệu nhựa cao cấp, đay thun giãn chất lượng, có khả năng chịu lực tốt, phù hợp nhiều đối tượng. dụng cụ kết hợp nhiều bài tập vai, lưng, mông, giúp máu huyết lưu thông, giảm thiểu tình trạng mỏi cơ.
- Với bài tập tổng hợp này, bạn sẽ nhanh chóng có được một vóc dáng thon gọn, chắc khỏe như ý.
- Thiết kế thông minh của Pull Reducer với vòng chân cố định, giúp bạn yên tâm khi tập luyện.
- Kích cỡ dụng cụ khá nhỏ gọn  nên bạn có thể tập mọi nơi, kể cả ở những không gian chật hẹp.',
                'hinh_anh' => '/storage/sanpham/daykeo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
