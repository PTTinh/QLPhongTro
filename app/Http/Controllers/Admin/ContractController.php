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
        $rooms = Room::all();
        $lessees = Lessee::all();
        return view('contract.index')->with('title', 'Quản lý hợp đồng')->with('contracts', $contracts)->with('rooms', $rooms)->with('lessees', $lessees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contract.create')->with('title', 'Tạo mới hợp đồng');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'start_date' => 'required',
        //     'end_date' => 'required',
        //     'month' => 'required',
        //     'price_eletric' => 'required',
        //     'price_water' => 'required',
        //     'other_fees' => 'required'
        // ]);
        // $data = $request->all();
        // $data['created_date'] = date('Y-m-d');
        // $data['created_by'] = Auth::id(); // Lấy id của user đang đăng nhập
        // $contract = new Contract($data);
        // $contract->save();  
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'month' => 'required',
            'price_eletric' => 'required',
            'price_water' => 'required',
            'other_fees' => 'required',
            'room_id' => 'required',
            'id_lessee' => 'required'
        ]);
        $contract = $request->only('start_date', 'end_date', 'month', 'price_eletric', 'price_water', 'other_fees');
        $contract['created_date'] = date('Y-m-d');
        $contract['created_by'] = Auth::id();
        $contract = new Contract($contract);
        $contract->save();
        $contractDetail = $request->only('contract_id', 'room_id', 'id_lessee');
        $contractDetail['contract_id'] = $contract->id;
        $contractDetail = new ContractDetails($contractDetail);
        $contractDetail->save();
        return redirect()->route('contracts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contractDetail = ContractDetails::where('contract_id', $id)->first();
        return view('contract.show')->with('title', 'Chi tiết hợp đồng')->with('contractDetail', $contractDetail);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contract = Contract::find($id);
        return view('contract.edit')->with('title', 'Chỉnh sửa hợp đồng')->with('contract', $contract);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'month' => 'required',
            'price_eletric' => 'required',
            'price_water' => 'required',
            'other_fees' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        $contract = Contract::find($id);
        $contract->update($data);
        return redirect()->route('contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contract::find($id);
        $contract->delete();
        return redirect()->route('contracts.index');
    }
}
