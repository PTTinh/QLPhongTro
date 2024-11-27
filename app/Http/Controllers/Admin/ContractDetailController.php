<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractDetails;
use App\Models\Lessee;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
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
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_lessee' => 'required',  
        ]);
        $data = $request->all();
        unset($data['_token']);
        $count = ContractDetails::where('contract_id', $id)->count();
        $capacity = Room::find(Contract::find($id)->room_id)->capacity;
        // Kiểm tra số lượng người thuê đã đủ chưa
        if ($count >= $capacity) {
            return redirect()->route('contracts.show', $id)->with('error', 'Hợp đồng đã đủ người thuê');
        }
        $contractdetail = ContractDetails::find($id);
        if($contractdetail == null) {
            $contractdetail = new ContractDetails();
            $contractdetail['contract_id'] = $id;
            $contractdetail['id_lessee'] = $data['id_lessee'];
            $contractdetail->save();
        }else{
            $contractdetail['id_lessee'] = $data['id_lessee'];
            ContractDetails::create($contractdetail->toArray());
        }
        return redirect()->route('contracts.show', $contractdetail->contract_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(ContractDetails::select('contract_id')->count() == 1){
            return redirect()->back();
        }
        $contractDetail = ContractDetails::find($id);
        $contractDetail->delete();
        return redirect()->back();
    }
}
