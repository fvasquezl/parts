<?php

use App\Http\Controllers\Admin\KitPartController;
use App\Http\Controllers\Admin\LcnController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\PartReferenceController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::redirect('/', 'login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->group(function () {
        Route::resource('kits', KitController::class);
        Route::post('/lcn',[LcnController::class,'index']);
        Route::post('/subcategories',[SubcategoryController::class,'index']);
        Route::resource('parts', PartReferenceController::class);
        Route::get('qrcode/{kit}', [QrCodeController::class,'print'])->name('qrcode');
        Route::get('/kit-parts/{kit}/edit',[KitPartController::class,'edit'])->name('kit-parts.edit');
        Route::patch('/kit-parts/{kit}',[KitPartController::class,'update'])->name('kit-parts.update');
    });


Route::prefix('/admin')->middleware('auth', 'role:admin')->group(function () {
    Route::resource('users', UsersController::class);
});
