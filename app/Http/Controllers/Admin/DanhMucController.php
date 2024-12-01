<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMuc\SuaDanhMucRequest;
use App\Http\Requests\DanhMuc\ThemDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsDanhMuc = DanhMuc::oldest('ma_danh_muc')->paginate(5);
        return view('admin.danhmuc.index', compact('dsDanhMuc'), ['title' => 'Quản lý danh mục']);
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
    public function store(ThemDanhMucRequest $request)
    {
        try {
            DanhMuc::create([
                'ten_danh_muc' => $request->input('ten_danh_muc')
            ]);

            toastr()->success('Thêm danh mục thành công!');
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
        $danhMuc = DanhMuc::findOrFail($id);

        return view('admin.danhmuc.update', compact('danhMuc'), ['title' => 'Chỉnh sửa danh mục']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuaDanhMucRequest $request, string $ma_danh_muc)
    {
        //dd($ma_danh_muc);
        //dd($request->input('sua_ten_danh_muc'));
        try {
            $danhMuc = DanhMuc::findOrFail($ma_danh_muc);
            $danhMuc->ten_danh_muc = $request->input('sua_ten_danh_muc');
            $danhMuc->save();

            toastr()->success('Cập nhật danh mục thành công!');

            return redirect()->route('admin.danhmuc');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Cập nhật danh mục thất bại!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $danhMuc = DanhMuc::findOrFail($id);
            $danhMuc->delete();

            toastr()->success('Xóa danh mục thành công!');

            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi xóa danh mục!');

            return redirect()->back();
        }
    }
}
