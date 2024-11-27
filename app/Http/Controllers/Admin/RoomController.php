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
        if (!$rooms) {
            abort(404);
        }
        return response()->json($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->custom_validation($request);
        $data = $request->all();
        unset($data['_token']);
        $room = new Room($data);
        $room->save();
        $alert = 'success';
        $message = 'Thêm phòng trọ thành công';
        return redirect()->route('rooms.index')->with($alert, $message);
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
        $room = Room::find($id);
        if (!$room) {
            abort(404);
        }
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->custom_validation($request);
        $data = $request->all();
        unset($data['_token']);
        $room = Room::find($id);
        $room->update($data);
        $alert = 'success';
        $message = 'Cập nhật phòng trọ thành công';
        return redirect()->route('rooms.index')->with($alert, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::find($id);
        if (Contract::where('room_id', $id)->count() > 0) {
            $alert = 'error';
            $message = 'Không thể xóa phòng trọ đã có hợp đồng';
        } else {
            $room->delete();
            $alert = 'success';
            $message = 'Xóa phòng trọ thành công';
        }
        return redirect()->route('rooms.index')->with($alert, $message);
    }
    public function custom_validation($request)
    {
        $rules = [
            'name' => 'required|max:250',
            'area' => 'required|numeric',
            'usable_area' => 'required|numeric|lte:area',
            'description' => 'nullable',
            'capacity' => 'required',
            'price' => 'required|numeric',
        ];
        $messages = [
            'name.required' => 'Tên phòng không được để trống',
            'name.max' => 'Tên phòng không được quá 250 ký tự',
            'area.required' => 'Diện tích không được để trống',
            'area.numeric' => 'Diện tích phải là số',
            'usable_area.required' => 'Diện tích sử dụng không được để trống',
            'usable_area.numeric' => 'Diện tích sử dụng phải là số',
            'usable_area.lte' => 'Diện tích sử dụng phải nhỏ hơn hoặc bằng diện tích',
            'description.nullable' => 'Mô tả không được để trống',
            'capacity.required' => 'Sức chứa không được để trống',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
        ];
        $request->validate($rules, $messages);
    }
}
