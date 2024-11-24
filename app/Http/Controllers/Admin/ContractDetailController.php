<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractDetails;
use App\Models\Lessee;
use App\Models\Room;
use Illuminate\Http\Request;

class ContractDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractDetails = ContractDetails::all();
        return view('contract_detail.index')->with('title', 'Quản lý chi tiết hợp đồng')->with('contractDetails', $contractDetails);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contracts = Contract::all();
        $rooms = Room::all();
        $lessees = Lessee::all();
        return view('contract_detail.create')->with('title', 'Tạo mới chi tiết hợp đồng')->with('contracts', $contracts)->with('rooms', $rooms)->with('lessees', $lessees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contract_id' => 'required',
            'room_id' => 'required',
            'id_lessee' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        $contractDetail = new ContractDetails($data);
        $contractDetail->save();
        return redirect()->route('contract-details.index');
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
        $contractDetail = ContractDetails::find($id);
        $contracts = Contract::all();
        $rooms = Room::all();
        $lessees = Lessee::all();
        return view('contract_detail.edit')->with('title', 'Chỉnh sửa chi tiết hợp đồng')->with('contractDetail', $contractDetail)->with('contracts', $contracts)->with('rooms', $rooms)->with('lessees', $lessees);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'contract_id' => 'required',
            'room_id' => 'required',
            'id_lessee' => 'required'
        ]);
        $data = $request->all();
        unset($data['_token']);
        $contractDetail = ContractDetails::find($id);
        $contractDetail->update($data);
        return redirect()->route('contract-details.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contractDetail = ContractDetails::find($id);
        $contractDetail->delete();
        return redirect()->route('contract-details.index');
    }
}
