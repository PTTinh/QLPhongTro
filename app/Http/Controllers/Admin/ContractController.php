<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Contract;
use App\Models\ContractDetails;
use App\Models\Lessee;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::all();
        $rooms = Room::whereDoesntHave('Contract')->get();
        $lessees = Lessee::whereDoesntHave('ContractDetails')->get();
        return view('contract.index')->with('title', 'Quản lý hợp đồng')->with('contracts', $contracts)->with('rooms', $rooms)->with('lessees', $lessees);
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
        $data = $request->all();
        $data['created_date'] = date('Y-m-d');
        $data['created_by'] = Auth::id(); // Lấy id của user đang đăng nhập
        $contract = new Contract($data);
        $contract->save();
        return redirect()->route('contracts.index')->with('success', 'Thêm hợp đồng thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract = Contract::find($id);
        $contractDetails = ContractDetails::where('contract_id', $id)->get();
        $lessees = Lessee::whereDoesntHave('contractDetails')->get(); //Lấy danh sách người thuê chưa có hợp đồng
        return view('contract.show')->with('title', 'Chi tiết hợp đồng')->with('contract', $contract)->with('contractDetails', $contractDetails)->with('lessees', $lessees);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contract = Contract::find($id);
        if (!$contract) {
            abort(404);
        }
        return response()->json($contract);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->custom_validation($request, $id);
        $data = $request->all();
        unset($data['_token']);
        $contract = Contract::find($id);
        $contract->update($data);
        return redirect()->route('contracts.index')->with('success', 'Cập nhật hợp đồng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contractDetails = ContractDetails::where('contract_id', $id)->get();
        foreach ($contractDetails as $contractDetail) {
            $contractDetail->delete();
        }
        $contract = Contract::find($id);
        if (!$contract) { //Neu khong tim thay hop dong
            $alert = 'error';
            $message = 'Không tìm thấy hợp đồng';
        }else{
            $contract->delete();
            $alert = 'success';
            $message = 'Xóa hợp đồng thành công';
        }
        return redirect()->route('contracts.index')->with($alert, $message);
    }
    public function custom_validation($request, $id = null)
    {
       $rules = [
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'month' => 'required|numeric|min:1',
            'price_eletric' => 'required|numeric|min:0',
            'price_water' => 'required|numeric|min:0',
            'other_fees' => 'required|numeric|min:0',
            'room_id' => 'required|unique:contracts,room_id'
        ];
        if ($id) {
            $rules['room_id'] = 'required|unique:contracts,room_id,' . $id; 
        }
        $messages = [
            'start_date.required' => 'Ngày bắt đầu không được để trống',
            'start_date.date' => 'Ngày bắt đầu không đúng định dạng',
            'start_date.after' => 'Ngày bắt đầu phải sau ngày hôm nay',
            'end_date.required' => 'Ngày kết thúc không được để trống',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'month.required' => 'Số tháng không được để trống',
            'month.numeric' => 'Số tháng phải là số',
            'month.min' => 'Số tháng phải lớn hơn hoặc bằng 1',
            'price_eletric.required' => 'Giá điện không được để trống',
            'price_eletric.numeric' => 'Giá điện phải là số',
            'price_eletric.min' => 'Giá điện phải lớn hơn hoặc bằng 0',
            'price_water.required' => 'Giá nước không được để trống',
            'price_water.numeric' => 'Giá nước phải là số',
            'price_water.min' => 'Giá nước phải lớn hơn hoặc bằng 0',
            'other_fees.required' => 'Phí khác không được để trống',
            'other_fees.numeric' => 'Phí khác phải là số',
            'other_fees.min' => 'Phí khác phải lớn hơn hoặc bằng 0',
            'room_id.required' => 'Phòng trọ không được để trống',
            'room_id.unique' => 'Phòng trọ đã có hợp đồng'
        ];
        $request->validate($rules, $messages);
    }
}
