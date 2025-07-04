<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('karyawan.index');
});


Route::prefix('manajemen-karyawan')->name('karyawan.')->group(function () {
    Route::get('/', [KaryawanController::class, 'index'])->name('index');
    Route::get('/create', [KaryawanController::class, 'create'])->name('create');
    Route::post('/store', [KaryawanController::class, 'store'])->name('store');
    Route::get('/edit/{uuid}', [KaryawanController::class, 'edit'])->name('edit');
    Route::put('/update/{uuid}', [KaryawanController::class, 'update'])->name('update');
    Route::delete('/delete/{uuid}', [KaryawanController::class, 'destroy'])->name('destroy');
});
