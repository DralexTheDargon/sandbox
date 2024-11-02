<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqAdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/faqs',[FaqController::class, 'index']) -> name('faqs.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/faqs', [FaqAdminController::class, 'index'])->name('faqs.index');
    Route::post('/faqs', [FaqAdminController::class, 'store'])->name('faqs.store');
    Route::put('/faqs/{id}', [FaqAdminController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [FaqAdminController::class, 'destroy'])->name('faqs.destroy');
});