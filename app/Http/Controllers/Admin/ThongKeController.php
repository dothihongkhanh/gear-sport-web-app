<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tongDanhMuc = DanhMuc::count();
        $tongSanPham = SanPham::count();
        $tongDonHang = DonHang::count();
        $doanhThu = DonHang::with('chiTietDonHang')->get()->sum(function ($donHang) {
            return $donHang->tongGiaTri();
        });

        $data = [
            'tongDanhMuc' => $tongDanhMuc,
            'tongSanPham' => $tongSanPham,
            'tongDonHang' => $tongDonHang,
            'doanhThu' => $doanhThu,
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
