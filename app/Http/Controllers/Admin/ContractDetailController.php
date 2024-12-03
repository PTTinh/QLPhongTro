<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\sendMail;
use App\Models\Contract;
use App\Models\ContractDetails;
use App\Models\Lessee;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContractDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
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
        abort(404);
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
        abort(404);
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
        if(ContractDetails::where('contract_id', $id)->where('id_lessee', $data['id_lessee'])->count() > 0){
            return redirect()->route('contracts.show', $id)->with('error', 'Người thuê đã tồn tại trong hợp đồng');
        }
        $contractdetail = new ContractDetails();
        $contractdetail['contract_id'] = $id;
        $contractdetail['id_lessee'] = $data['id_lessee'];
        $contractdetail->save();
        $lessee = Lessee::find($data['id_lessee']);
        sendMail::dispatch($lessee->email, $contractdetail->id)->delay(now()->addSeconds(5));
        return redirect()->route('contracts.show', $contractdetail->contract_id)->with('success', 'Thêm người thuê thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contractDetail = ContractDetails::find($id);
        if (!$contractDetail) {
            $alert = 'error';
            $message = 'Không tìm thấy người tham gia hợp đồng';
        } else {
            $contractDetail->delete();
            $alert = 'success';
            $message = 'Xóa người tham gia hợp đồng thành công';
        }
        return redirect()->back()->with($alert, $message);
    }
}
