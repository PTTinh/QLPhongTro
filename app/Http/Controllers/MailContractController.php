<?php

namespace App\Http\Controllers;

use App\Models\ContractDetails;
use App\Models\Lessee;
use Illuminate\Http\Request;

class MailContractController extends Controller
{
    public function index(string $id, string $uid)
    {
        $contractDetail = ContractDetails::find($id);
        if (!$contractDetail || $contractDetail->lessee->id != $uid) {
            abort(404);
        }
        return view('mail.mail_contract')->with('contractDetail', $contractDetail);
    }

    public function Mailport(Request $request)
    {
        $request->validate(
            [
                'cccd_number' => 'required',
                'cccd_front_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cccd_back_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'cccd_number.required' => 'Vui lòng nhập số CCCD',
                'cccd_front_image.required' => 'Vui lòng chọn ảnh mặt trước CCCD',
                'cccd_front_image.image' => 'Ảnh mặt trước CCCD không đúng định dạng',
                'cccd_front_image.mimes' => 'Ảnh mặt trước CCCD phải là file ảnh có định dạng: jpeg, png, jpg, gif, svg',
                'cccd_front_image.max' => 'Dung lượng ảnh mặt trước CCCD không được vượt quá 2MB',
                'cccd_back_image.required' => 'Vui lòng chọn ảnh mặt sau CCCD',
                'cccd_back_image.image' => 'Ảnh mặt sau CCCD không đúng định dạng',
                'cccd_back_image.mimes' => 'Ảnh mặt sau CCCD phải là file ảnh có định dạng: jpeg, png, jpg, gif, svg',
                'cccd_back_image.max' => 'Dung lượng ảnh mặt sau CCCD không được vượt quá 2MB'
            ]
        );
        $lessee = Lessee::where('cccd_number', $request->cccd_number)->first();
        if (!$lessee) { //kt xem có tồn tại người thuê nhà không nếu không thì thông báo
            $alert = 'error';
            $message = 'Vui lòng kiểm tra lại số CCCD';
        } else {
            $contractDetail = ContractDetails::where('id_lessee', $lessee->id)->first();
            if (!$contractDetail) { //kt xem người thuê nhà đã ký hợp đồng chưa nếu chưa thì thông báo
                $alert = 'error';
                $message = 'Người thuê nhà chưa có hợp đồng';
            } else {
                if ($contractDetail->is_signed == 1) {
                    $alert = 'error';
                    $message = 'Người thuê nhà đã ký hợp đồng rồi';
                } else {
                    $file = [];
                    if($lessee->cccd_front_image) {
                        $file[] = public_path('images/' . $lessee->cccd_front_image);
                    }
                    if($lessee->cccd_back_image) {
                        $file[] = public_path('images/' . $lessee->cccd_back_image);
                    }
                    if(count($file) > 0) {
                        foreach ($file as $f) {
                            if (file_exists($f)) {
                                unlink($f);
                            }
                        }
                    }
                    $cccd_front_image = $request->file('cccd_front_image');
                    $cccd_back_image = $request->file('cccd_back_image');
                    $cccd_front_image_name = time() . '-' . $cccd_front_image->getClientOriginalName();
                    $cccd_back_image_name = time() . '-' . $cccd_back_image->getClientOriginalName();
                    $cccd_front_image->move(public_path('images'), $cccd_front_image_name);
                    $cccd_back_image->move(public_path('images'), $cccd_back_image_name);
                    $lessee->cccd_front_image = $cccd_front_image_name;
                    $lessee->cccd_back_image = $cccd_back_image_name;
                    $lessee->save();
                    $contractDetail->is_signed = 1;
                    $contractDetail->signed_at = date('Y-m-d');
                    $contractDetail->save();
                    $alert = 'success';
                    $message = 'Đã ký hợp đồng thành công';
                }
            }
        }

        return redirect()->back()->with($alert, $message);
    }
}
