<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('roms.index');
});
Route::resource('rooms', RoomController::class);
