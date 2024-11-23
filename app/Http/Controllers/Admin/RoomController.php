<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
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
        return view('rooms.create')->with('title', 'Thêm phòng trọ');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'area' => 'required',
            'usable_area' => 'required',
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
        return view('rooms.edit')->with('title', 'Chỉnh sửa phòng trọ')->with('room', $room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'area' => 'required',
            'usable_area' => 'required',
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
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
