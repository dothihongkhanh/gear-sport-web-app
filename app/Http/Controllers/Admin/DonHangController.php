<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TrangThaiDonHang;
use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsDonHang = DonHang::withTrashed()->with('nguoiDung')->get();

        return view('admin.donhang.index', compact('dsDonHang'), ['title' => 'Quản lý đơn hàng']);
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
    public function show(string $ma_don_hang)
    {
        $donHang = DonHang::withTrashed()->with('chiTietDonHang')->findOrFail($ma_don_hang);

        return view('admin.donhang.detail', compact('donHang'), [
            'title' => 'Chi tiết đơn hàng'
        ]);
    }

    /**
     * Show the form for approval the specified resource.
     */
    public function approval(string $ma_don_hang)
    {
        $donHang = DonHang::findOrFail($ma_don_hang);

        if ($donHang->trang_thai == TrangThaiDonHang::DangChoXuLy) {
            $donHang->trang_thai = TrangThaiDonHang::DangGiaoHang;
            $donHang->save();
            toastr()->success('Duyệt đơn hàng thành công!');

            return redirect()->route('admin.donhang');
        }
    }

    public function filter(Request $request)
    {
        $trangThai = $request->get('trang_thai');

        $dsDonHang = DonHang::when($trangThai, function ($query) use ($trangThai) {
            $query->where('trang_thai', $trangThai);
        })->get();

        return view('admin.donhang.index', compact('trangThai', 'dsDonHang'), [
            'title' => 'Quản lý đơn hàng'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
