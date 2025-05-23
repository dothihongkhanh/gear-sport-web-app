<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsNguoiDung = NguoiDung::withTrashed()->where('ma_quyen', 2)->get();

        return view('admin.nguoidung.index', compact('dsNguoiDung'), ['title' => 'Quản lý người dùng']);
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
    public function destroy(string $ma_nguoi_dung)
    {
        try {
            $nguoiDung = NguoiDung::findOrFail($ma_nguoi_dung);
            $nguoiDung->delete();
            toastr()->success('Khóa người dùng thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi khóa người dùng!');
        }

        return redirect()->back();
    }

    public function restore($ma_nguoi_dung)
    {
        try {
            $nguoiDung = NguoiDung::withTrashed()->findOrFail($ma_nguoi_dung);
            $nguoiDung->restore(); // Sử dụng phương thức restore để khôi phục
            toastr()->success('Mở khóa người dùng thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi mở khóa người dùng!');
        }

        return redirect()->back();
    }
}
