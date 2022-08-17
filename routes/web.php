<?php

use App\Http\Controllers\Admin\LcnController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\PartReferenceController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->group(function () {
        Route::resource('kits', KitController::class);
        Route::post('/lcn',[LcnController::class,'index']);
        Route::post('/subcategories',[SubcategoryController::class,'index']);

        Route::resource('parts', PartReferenceController::class);
    });

//Route::resource('subcategories', SubCategoryController::class);
