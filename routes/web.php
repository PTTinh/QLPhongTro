<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()==false) {
        return redirect()->route('rooms.index');
    }
    return view('home');
})->name('home');
Route::resource('rooms', RoomController::class);
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/login', [AccountController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');