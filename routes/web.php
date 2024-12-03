<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ContractDetailController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LesseeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\MailContractController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mail-contract/{id}/{uid}', [MailContractController::class, 'index'])->name('mail-contract');
Route::post('/mail-contract', [MailContractController::class, 'Mailport'])->name('mail-contract.post');
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/login', [AccountController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::resources([
    'rooms' => RoomController::class,
    'lessees' => LesseeController::class,
    'contracts' => ContractController::class,
    'contract-details' => ContractDetailController::class,
]);
Route::post('/rooms/search', [RoomController::class, 'search'])->name('rooms.search');
Route::post('/lessees/search', [LesseeController::class, 'search'])->name('lessees.search');
Route::post('/contracts/search', [ContractController::class, 'search'])->name('contracts.search');
