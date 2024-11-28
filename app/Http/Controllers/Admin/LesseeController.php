<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\ContractDetails;
use App\Models\Lessee;
use Illuminate\Http\Request;

class LesseeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessees = Lessee::all();
        return view('lessee.index')->with('title', 'Quản lý người thuê')->with('lessees', $lessees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->custom_validation($request);
        $lessee = new Lessee();
        if ($request->hasFile('cccd_front_image')) {
            $img_front = time() . '-' . $request->cccd_front_image->getClientOriginalName();
            $request->cccd_front_image->move(public_path('images'), $img_front);
            $lessee->cccd_front_image = $img_front;
        }
        if ($request->hasFile('cccd_back_image')) {
            $img_back = time() . '-' . $request->cccd_back_image->getClientOriginalName();
            $request->cccd_back_image->move(public_path('images'), $img_back);
            $lessee->cccd_back_image = $img_back;
        }
        $lessee->name = $request->name;
        $lessee->phone = $request->phone;
        $lessee->email = $request->email;
        $lessee->address = $request->address;
        $lessee->job = $request->job;
        $lessee->dob = $request->dob;
        $lessee->cccd_number = $request->cccd_number;
        $lessee->save();
        return redirect()->route('lessees.index')->with('success', 'Thêm người thuê thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lessee = Lessee::find($id);
        if (!$lessee) {
            return redirect()->route('lessees.index');
        }
        return response()->json($lessee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->custom_validation($request, $id);
        $lessee = Lessee::find($id);
        if ($lessee) { // Nếu người thuê tồn tại
            $files = [];
            //kiểm tra xem người dùng có upload ảnh mới không nếu có thì xóa ảnh cũ và lưu ảnh mới
            if ($request->hasFile('cccd_front_image')) {
                $img_front = time() . '-' . $request->cccd_front_image->getClientOriginalName();
                $request->cccd_front_image->move(public_path('images'), $img_front);
                if (isset($lessee->cccd_front_image)) { //
                    $files[] = public_path('images') . "/" . $lessee->cccd_front_image;
                }
                $lessee->cccd_front_image = $img_front;
            }
            if ($request->hasFile('cccd_back_image')) {
                $img_back = time() . '-' . $request->cccd_back_image->getClientOriginalName();
                $request->cccd_back_image->move(public_path('images'), $img_back);
                if (isset($lessee->cccd_back_image)) {
                    $files[] = public_path('images') . "/" . $lessee->cccd_back_image;
                }
                $lessee->cccd_back_image = $img_back;
            }
            //Xóa ảnh cũ
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $lessee->name = $request->name;
            $lessee->phone = $request->phone;
            $lessee->email = $request->email;
            $lessee->address = $request->address;
            $lessee->job = $request->job;
            $lessee->dob = $request->dob;
            $lessee->cccd_number = $request->cccd_number;
            $lessee->save();
            $alert = 'success';
            $message = 'Cập nhật người thuê thành công';
        } else {
            $alert = 'error';
            $message = 'Người thuê không tồn tại';
        }
        return redirect()->route('lessees.index')->with($alert, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lessee = Lessee::find($id);
        if (!$lessee) {
            $alert = 'error';
            $message = 'Người thuê không tồn tại';
        } else if (ContractDetails::where('id_lessee', $id)->count() > 0) {
            $alert = 'error';
            $message = 'Người thuê đã ký hợp đồng, không thể xóa';
        } else {
            $files = [];
            if (isset($lessee->cccd_front_image)) {
                $files[] = public_path('images') . "/" . $lessee->cccd_front_image;
            }
            if (isset($lessee->cccd_back_image)) {
                $files[] = public_path('images') . "/" . $lessee->cccd_back_image;
            }
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $lessee->delete();
            $alert = 'success';
            $message = 'Xóa người thuê thành công';
        }
        return redirect()->route('lessees.index')->with($alert, $message);
    }
    public function custom_validation($request, $id = null)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|digits_between:10,11|numeric|unique:lessees,phone',
            'email' => 'required',
            'address' => 'nullable',
            'job' => 'required',
            'dob' => 'required|date|before:' . now()->subYears(14)->format('Y-m-d'),
            'cccd_number' => 'required|numeric|unique:lessees,cccd_number',
            'cccd_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cccd_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        if ($id) {
            $rules['phone'] = 'required|digits_between:10,11|numeric|unique:lessees,phone,' . $id;
            $rules['cccd_number'] = 'required|numeric|unique:lessees,cccd_number,' . $id;
        }
        $msg = [
            'name.required' => 'Tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.digits_between' => 'Số điện thoại không đúng định dạng',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'email.required' => 'Email không được để trống',
            'job.required' => 'Nghề nghiệp không được để trống',
            'dob.required' => 'Ngày sinh không được để trống',
            'dob.date' => 'Ngày sinh không đúng định dạng',
            'dob.before' => 'Người thuê phải từ 14 tuổi trở lên',
            'cccd_number.required' => 'Số CCCD không được để trống',
            'cccd_number.numeric' => 'Số CCCD không đúng định dạng',
            'cccd_number.unique' => 'Số CCCD đã tồn tại',
            'cccd_front_image.image' => 'Ảnh không đúng định dạng',
            'cccd_front_image.mimes' => 'Ảnh không đúng định dạng',
            'cccd_front_image.max' => 'Ảnh quá lớn',
            'cccd_back_image.image' => 'Ảnh không đúng định dạng',
            'cccd_back_image.mimes' => 'Ảnh không đúng định dạng',
            'cccd_back_image.max' => 'Ảnh quá lớn'
        ];
        $request->validate($rules, $msg);
    }
}
