<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThuongHieu\SuaThuongHieuRequest;
use App\Http\Requests\ThuongHieu\ThemThuongHieuRequest;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;

class ThuongHieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsThuongHieu = ThuongHieu::oldest('ma_thuong_hieu')->paginate(5);
        return view('admin.thuonghieu.index', compact('dsThuongHieu'), ['title' => 'Quản lý thương hiệu']);
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
    public function store(ThemThuongHieuRequest $request)
    {
        try {
            ThuongHieu::create([
                'ten_thuong_hieu' => $request->input('ten_thuong_hieu')
            ]);

            toastr()->success('Thêm thương hiệu thành công!');
        } catch (\Exception $err) {
            toastr()->error('Đã xảy ra lỗi, vui lòng thử lại sau.');
        }

        return redirect()->back();
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
        $thuongHieu = ThuongHieu::findOrFail($id);

        return view('admin.thuonghieu.update', compact('thuongHieu'), ['title' => 'Chỉnh sửa thương hiệu']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuaThuongHieuRequest $request, string $ma_thuong_hieu)
    {
        try {
            $thuongHieu = ThuongHieu::findOrFail($ma_thuong_hieu);
            $thuongHieu->ten_thuong_hieu = $request->input('sua_ten_thuong_hieu');
            $thuongHieu->save();

            toastr()->success('Cập nhật thương hiệu thành công!');

            return redirect()->route('admin.thuonghieu');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Cập nhật thương hiệu thất bại!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $thuongHieu = ThuongHieu::findOrFail($id);
            $thuongHieu->delete();

            toastr()->success('Xóa thương hiệu thành công!');

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi xóa thương hiệu!');

            return redirect()->back();
        }
    }
}
