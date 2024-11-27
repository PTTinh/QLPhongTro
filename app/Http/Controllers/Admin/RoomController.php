<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Contract;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index')->with('title', 'Quản lý phòng trọ')->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::all();
        if(!$rooms) {
            abort(404);
        }
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'area' => 'required|numeric',
            'usable_area' => 'required|numeric|lte:area',
            'description' => 'nullable',
            'capacity' => 'required',
            'price' => 'required',
        ]);
        $data = $request->all();
        unset($data['_token']);
        $room = new Room($data);
        $room->save();
        return redirect()->route('rooms.index');        
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
        $room = Room::find($id);
        if(!$room) {
            abort(404);
        }
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'area' => 'required|numeric',
            'usable_area' => 'required|numeric|lte:area',
            'description' => 'nullable',
            'capacity' => 'required',
            'price' => 'required',
        ]);
        $data = $request->all();
        unset($data['_token']);
        $room = Room::find($id);
        $room->update($data);
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Contract::where('room_id', $id)->count() > 0) {
            return redirect()->route('rooms.index')->with('error', 'Phòng trọ đã có hợp đồng');
        }
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
