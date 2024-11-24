<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Lessee;
use Illuminate\Http\Request;

class LesseeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessees = Lessee::all();
        return view('lessee.index')->with('title', 'Quản lý người thuê')->with('lessees', $lessees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lessee.create')->with('title', 'Thêm người thuê');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'occupation' => 'required',
            'birth_year' => 'required',
            'cccd_number' => 'required',
            'cccd_front_image' => 'nullable',
            'cccd_back_image' => 'nullable',
        ]);
        $data = $request->all();
        unset($data['_token']);
        $lessee = new Lessee($data);
        $lessee->save();
        return redirect()->route('lessees.index');
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
        $lessee = Lessee::find($id);
        return view('lessee.edit')->with('title', 'Chỉnh sửa người thuê')->with('lessee', $lessee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'occupation' => 'required',
            'birth_year' => 'required',
            'cccd_number' => 'required',
            'cccd_front_image' => 'nullable',
            'cccd_back_image' => 'nullable',
        ]);
        $data = $request->all();
        unset($data['_token']);
        $lessee = Lessee::find($id);
        $lessee->update($data);
        return redirect()->route('lessees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lessee = Lessee::find($id);
        $lessee->delete();
        return redirect()->route('lessees.index');
    }
}
