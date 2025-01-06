<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tongDanhMuc = DanhMuc::count();
        $tongSanPham = SanPham::count();
        $tongDonHang = DonHang::count();

        $doanhThu = DonHang::with('chiTietDonHang')->get()->sum(function ($donHang) {
            return $donHang->tongGiaTri();
        });

        $dsDonHang = DonHang::withTrashed();

        $filterMonth = $request->input('selectedMonthYear');
        if ($filterMonth !== 'all') {
            $dsDonHang = $dsDonHang->whereRaw('DATE_FORMAT(created_at, "%m-%Y") = ?', [$filterMonth]);
        }

        $doanhThuTheoThang = $dsDonHang->get()->sum(function ($donHang) {
            return $donHang->tongGiaTri();
        });

        $dsThangNam = DonHang::withTrashed()
            ->selectRaw('DATE_FORMAT(created_at, "%m-%Y") as monthYear')
            ->distinct()
            ->pluck('monthYear');

        $doanhThuData = [];
        foreach ($dsThangNam as $thangNam) {
            $doanhThuTheoThang = DonHang::withTrashed()
                ->whereRaw('DATE_FORMAT(created_at, "%m-%Y") = ?', [$thangNam])
                ->get()
                ->sum(function ($donHang) {
                    return $donHang->tongGiaTri();
                });
            $doanhThuData[] = [
                'monthYear' => $thangNam,
                'totalRevenue' => $doanhThuTheoThang,
            ];
        }


        $top5SanPham = DB::table('chi_tiet_don_hang as ctdh')
            ->join('chi_tiet_san_pham as ctsp', 'ctdh.ma_chi_tiet_san_pham', '=', 'ctsp.ma_chi_tiet_san_pham')
            ->join('san_pham as sp', 'ctsp.ma_san_pham', '=', 'sp.ma_san_pham')
            ->select('sp.ma_san_pham', 'sp.ten_san_pham', DB::raw('SUM(ctdh.so_luong_dat) as total_quantity'))
            ->groupBy('sp.ma_san_pham', 'sp.ten_san_pham')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $data = [
            'filterMonth' => $filterMonth,
            'dsThangNam' => $dsThangNam,
            'tongDanhMuc' => $tongDanhMuc,
            'tongSanPham' => $tongSanPham,
            'tongDonHang' => $tongDonHang,
            'doanhThu' => $doanhThu,
            'doanhThuData' => $doanhThuData,
            'top5SanPham' => $top5SanPham,
            'title' => 'Thống kê',
        ];

        return view('admin.dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
