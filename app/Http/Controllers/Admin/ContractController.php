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
        $rooms = Room::whereNotIn('id', $contracts->pluck('room_id'))->get();
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
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'month' => 'required',
            'price_eletric' => 'required',
            'price_water' => 'required',
            'other_fees' => 'required',
            'room_id' => 'required'
        ]);
        $data = $request->all();
        $data['created_date'] = date('Y-m-d');
        $data['created_by'] = Auth::id(); // Lấy id của user đang đăng nhập
        $contract = new Contract($data);
        $contract->save();
        return redirect()->route('contracts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contract = Contract::find($id);
        $contractDetails = ContractDetails::where('contract_id', $id)->get();
        $lessees = Lessee::all();
        $rooms = Room::all();
        return view('contract.show')->with('title', 'Chi tiết hợp đồng')->with('contract', $contract)->with('contractDetails', $contractDetails)->with('lessees', $lessees)->with('rooms', $rooms);
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
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'month' => 'required',
            'price_eletric' => 'required',
            'price_water' => 'required',
            'other_fees' => 'required',
            'room_id' => 'required'
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
        $contractDetails = ContractDetails::where('contract_id', $id)->get();
        foreach ($contractDetails as $contractDetail) {
            $contractDetail->delete();
        }
        $contract = Contract::find($id);
        $contract->delete();
        return redirect()->route('contracts.index');
    }
}
