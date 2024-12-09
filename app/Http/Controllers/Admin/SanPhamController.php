<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPham\SuaSanPhamRequest;
use App\Http\Requests\SanPham\ThemChiTietSanPhamRequest;
use App\Http\Requests\SanPham\ThemSanPhamRequest;
use App\Models\ChiTietSanPham;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dsSanPham = SanPham::withTrashed()->with(['danhMuc', 'thuongHieu'])->oldest('ma_san_pham')->paginate(10);

        return view('admin.sanpham.index', compact('dsSanPham'), [
            'title' => 'Danh sách sản phẩm'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dsDanhMuc = DanhMuc::get();
        $dsThuongHieu = ThuongHieu::get();

        return view('admin.sanpham.create', compact('dsDanhMuc', 'dsThuongHieu'),  [
            'title' => 'Thêm sản phẩm'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeWithDetails(ThemSanPhamRequest $request)
    {
        try {
            $ma_danh_muc = $request->input('ma_danh_muc');
            $ma_thuong_hieu = $request->input('ma_thuong_hieu');
            $ten_san_pham = $request->input('ten_san_pham');
            $mo_ta = $request->input('mo_ta');
            $hinh_anh = $request->file('hinh_anh');

            $url_hinh_anh = $hinh_anh->store('sanpham', 'public');

            $sanPham = SanPham::create([
                'ma_danh_muc' => $ma_danh_muc,
                'ma_thuong_hieu' => $ma_thuong_hieu,
                'ten_san_pham' => $ten_san_pham,
                'mo_ta' => $mo_ta,
                'hinh_anh' => Storage::url($url_hinh_anh),
            ]);

            $ma_san_pham = $sanPham->ma_san_pham;
            $chiTietSanPham = $request->input('chiTietSanPham', []);
            foreach ($chiTietSanPham as $index => $chiTiet) {
                $hinh_anh_chi_tiet = $request->file('chiTietSanPham.' . $index . '.hinh_anh_chi_tiet');
                if ($hinh_anh_chi_tiet) {
                    $url_hinh_anh_chi_tiet = $hinh_anh_chi_tiet->store('sanpham/chitiet', 'public');
                    $url_hinh_anh_chi_tiet = Storage::url($url_hinh_anh_chi_tiet);
                } else {
                    $url_hinh_anh_chi_tiet = Storage::url($url_hinh_anh);
                }

                $chiTietSanPham = ChiTietSanPham::create([
                    'ma_san_pham' => $ma_san_pham,
                    'thuoc_tinh' => $chiTiet['thuoc_tinh'],
                    'gia' => $chiTiet['gia'],
                    'hinh_anh_chi_tiet' => $url_hinh_anh_chi_tiet,
                    'so_luong' => $chiTiet['so_luong'],
                ]);
            }
            toastr()->success('Thêm sản phẩm thành công!');

            return redirect()->route('admin.sanpham');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Có lỗi khi thêm sản phẩm!');

            return redirect()->back();
        }
    }

    public function storeWithNoDetails(ThemSanPhamRequest $request)
    {
        try {
            $ma_danh_muc = $request->input('ma_danh_muc');
            $ma_thuong_hieu = $request->input('ma_thuong_hieu');
            $ten_san_pham = $request->input('ten_san_pham');
            $mo_ta = $request->input('mo_ta');
            $hinh_anh = $request->file('hinh_anh');
            $gia = $request->input('gia');
            $so_luong = $request->input('so_luong');

            $url_hinh_anh = $hinh_anh->store('sanpham', 'public');

            $sanPham = SanPham::create([
                'ma_danh_muc' => $ma_danh_muc,
                'ma_thuong_hieu' => $ma_thuong_hieu,
                'ten_san_pham' => $ten_san_pham,
                'mo_ta' => $mo_ta,
                'hinh_anh' => Storage::url($url_hinh_anh),
            ]);

            $ma_san_pham = $sanPham->ma_san_pham;

            ChiTietSanPham::create([
                'ma_san_pham' => $ma_san_pham,
                'thuoc_tinh' => null,
                'gia' => $gia,
                'hinh_anh_chi_tiet' => Storage::url($url_hinh_anh),
                'so_luong' => $so_luong,
            ]);
            toastr()->success('Thêm sản phẩm thành công!');

            return redirect()->route('admin.sanpham');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Có lỗi khi thêm sản phẩm!');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ma_san_pham)
    {
        $sanPham = SanPham::withTrashed()->with('chiTietSanPham')->findOrFail($ma_san_pham);
        return view('admin.sanpham.detail', compact('sanPham'), [
            'title' => 'Chi tiết sản phẩm'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeChiTiet(ThemChiTietSanPhamRequest $request, string $ma_san_pham)
    {
        try {
            $sanPham = SanPham::with('chiTietSanPham')->findOrFail($ma_san_pham);

            $thuoc_tinh = $request->input('thuoc_tinh');
            $gia = $request->input('gia');
            $so_luong = $request->input('so_luong');
            $hinh_anh_chi_tiet = $request->file('hinh_anh_chi_tiet');
            // dd($hinh_anh_chi_tiet);

            if ($hinh_anh_chi_tiet) {
                $url_hinh_anh_chi_tiet = $hinh_anh_chi_tiet->store('sanpham/chitiet', 'public');
            } else {
                $url_hinh_anh_chi_tiet = str_replace('/storage/', '', $sanPham->hinh_anh);
            }

            $chiTietSanPham = ChiTietSanPham::create([
                'ma_san_pham' => $ma_san_pham,
                'thuoc_tinh' => $thuoc_tinh,
                'hinh_anh_chi_tiet' => Storage::url($url_hinh_anh_chi_tiet),
                'gia' => $gia,
                'so_luong' => $so_luong,
            ]);
            $chiTietSanPham->sanPham()->associate($sanPham);
            $chiTietSanPham->save();
            toastr()->success('Thêm chi tiết sản phẩm thành công!');
        } catch (\Exception $e) {
            dd($e);
            toastr()->error('Có lỗi khi thêm chi tiết sản phẩm!');
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $ma_san_pham)
    {
        $dsDanhMuc = DanhMuc::get();
        $dsThuongHieu = ThuongHieu::get();
        $sanPham = SanPham::with('chiTietSanPham')->findOrFail($ma_san_pham);
        return view('admin.sanpham.update', compact(['dsDanhMuc', 'dsThuongHieu', 'sanPham']), [
            'title' => 'Cập nhật sản phẩm'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuaSanPhamRequest $request, string $ma_san_pham)
    {
        try {
            $sanPham = SanPham::findOrFail($ma_san_pham);
            $hinh_anh = $request->file('hinh_anh');

            if ($request->hasFile('hinh_anh')) {
                $url_hinh_anh = $hinh_anh->store('sanpham', 'public');
            } else {
                $url_hinh_anh = str_replace('/storage/', '', $sanPham->hinh_anh);
            }

            $sanPham->update([
                'ma_danh_muc' => $request->input('ma_danh_muc'),
                'ma_thuong_hieu' => $request->input('ma_thuong_hieu'),
                'ten_san_pham' => $request->input('ten_san_pham'),
                'mo_ta' => $request->input('mo_ta'),
                'hinh_anh' => Storage::url($url_hinh_anh),
            ]);

            if ($request->has('chiTietSanPham')) {

                $chiTietSanPhamList = $request->input('chiTietSanPham', []);

                foreach ($chiTietSanPhamList as $index => $chiTiet) {
                    $hinh_anh_chi_tiet = $request->file('chiTietSanPham.' . $index . '.hinh_anh_chi_tiet');
                    if ($hinh_anh_chi_tiet) {
                        $url_hinh_anh_chi_tiet = $hinh_anh_chi_tiet->store('sanpham/chitiet', 'public');
                        $url_hinh_anh_chi_tiet = Storage::url($url_hinh_anh_chi_tiet);
                    } else {
                        $url_hinh_anh_chi_tiet = $chiTiet['hinh_anh_chi_tiet_an'];
                    }
                    $chiTietSanPham = ChiTietSanPham::findOrFail($chiTiet['ma_chi_tiet_san_pham']);
                    $chiTietSanPham->update([
                        'thuoc_tinh' => $chiTiet['thuoc_tinh'],
                        'gia' => $chiTiet['gia'],
                        'hinh_anh_chi_tiet' => $url_hinh_anh_chi_tiet,
                        'so_luong' => $chiTiet['so_luong'],
                    ]);
                }
            }
            toastr()->success('Cập nhật Sản phẩm thành công!');

            return redirect()->route('admin.sanpham');
        } catch (\Exception $err) {
            dd($err);
            toastr()->error('Cập nhật Sản phẩm thất bại!');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ma_san_pham)
    {
        try {
            $sanPham = SanPham::findOrFail($ma_san_pham);
            $sanPham->delete();
            toastr()->success('Khóa sản phẩm thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi khóa sản phẩm!');
        }

        return redirect()->back();
    }

    public function restore($ma_san_pham)
    {
        try {
            $sanPham = SanPham::withTrashed()->findOrFail($ma_san_pham);
            $sanPham->restore(); // Sử dụng phương thức restore để khôi phục
            toastr()->success('Mở khóa sản phẩm thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi mở khóa sản phẩm!');
        }

        return redirect()->back();
    }

    public function destroyChiTiet($ma_chi_tiet_san_pam)
    {
        try {
            $chiTiet = ChiTietSanPham::findOrFail($ma_chi_tiet_san_pam);
            $chiTiet->delete();
            toastr()->success('Khóa chi tiết SP thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi khóa chi tiết SP!');
        }

        return redirect()->back();
    }

    public function restoreChiTiet($ma_chi_tiet_san_pam)
    {
        try {
            $chiTiet = ChiTietSanPham::withTrashed()->findOrFail($ma_chi_tiet_san_pam);
            $chiTiet->restore(); // Sử dụng phương thức restore để khôi phục
            toastr()->success('Mở khóa chi tiết SP thành công!');
        } catch (\Exception $e) {
            toastr()->error('Có lỗi khi mở khóa chi tiết SP!');
        }

        return redirect()->back();
    }
}
