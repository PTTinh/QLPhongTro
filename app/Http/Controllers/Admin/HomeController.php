<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Contract;
use App\Models\ContractDetails;
use App\Models\Lessee;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        $roomCount = Room::count();
        $emptyRoomCount = Room::where('status', 0)->count();
        $occupiedRoomCount = Room::where('status', 1)->count();
        $LesseeCount = Lessee::count();
        $emptyLesseeCount = Lessee::whereDoesntHave('contractDetails')->count();
        $occupiedLesseeCount = Lessee::whereHas('contractDetails')->count();
        $expiringContractsCount = Contract::where('end_date', '<', now()->addMonth())->count();
        $validContractsCount = Contract::where('end_date', '>', now()->addMonth())->count();
        return view('home')->with('title', 'Thống kê')
                            ->with('roomCount', $roomCount)
                            ->with('LesseeCount', $LesseeCount)
                            ->with('expiringContractsCount', $expiringContractsCount)
                            ->with('emptyRoomCount', $emptyRoomCount)
                            ->with('occupiedRoomCount', $occupiedRoomCount)
                            ->with('emptyLesseeCount', $emptyLesseeCount)
                            ->with('occupiedLesseeCount', $occupiedLesseeCount)
                            ->with('validContractsCount', $validContractsCount);
        
    }
}
