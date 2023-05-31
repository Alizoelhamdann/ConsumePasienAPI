<?php

use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PasienController::class, 'index'])->name('home');
Route::get('/add', [PasienController::class, 'create'])->name('add');
Route::post('/add/send', [PasienController::class, 'store'])->name('send');
Route::get('/edit/{id}', [PasienController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [PasienController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [PasienController::class, 'delete'])->name('delete');
Route::get('/trash', [PasienController::class, 'trash'])->name('trash');
Route::get('/trash/restore/{id}', [PasienController::class, 'restore'])->name('restore');
Route::get('/trash/delete/permanent/{id}', [PasienController::class, 'permanent'])->name('permanent');

