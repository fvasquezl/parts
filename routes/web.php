<?php

use App\Http\Controllers\AddInvController;
use App\Http\Controllers\Admin\KitPartController;
use App\Http\Controllers\Admin\KitPartUpdateController;
use App\Http\Controllers\Admin\LcnController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ValidateController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\BoxShelfController;
use App\Http\Controllers\FillBoxController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\PartReferenceController;
use App\Http\Controllers\RemoveInvController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\Skus\SKUStep1Controller;
use App\Http\Controllers\VersionController;
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

Route::redirect('/', 'login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->group(function () {
        Route::resource('kits', KitController::class);
        Route::resource('boxes', BoxController::class);
        Route::resource('shelves', ShelfController::class);
        Route::resource('fill-box', FillBoxController::class);
        Route::resource('add-inv', AddInvController::class);
        Route::resource('rem-inv', RemoveInvController::class);

        Route::resource('sku/step1', SKUStep1Controller::class)
            ->only([
                'index'
            ]);

        Route::resource('boxShelf', BoxShelfController::class)
            ->only([
                'index', 'update'
            ])
            ->parameters([
            'boxShelf' => 'shelf'
        ]);

        Route::view('/boxesRemove','boxes.delete');


        Route::resource('version', VersionController::class)
            ->only([
                'index', 'store'
            ]);
        Route::resource('skus', SkuController::class);


        Route::post('/lcn', [LcnController::class, 'index']);
        Route::post('/lcn/getSkus', [LcnController::class, 'getSkus']);
        Route::post('/lcn/saveSkus', [LcnController::class, 'saveSkus']);

        Route::post('/subcategories', [SubcategoryController::class, 'index']);
        Route::resource('parts', PartReferenceController::class);

        Route::get('qrcode/{kit}', [QrCodeController::class, 'print'])->name('qrcode');
        Route::get('qrcode/box/{box}', [QrCodeController::class, 'box'])->name('qrcode.box');
        Route::get('qrcode/shelf/{shelf}', [QrCodeController::class, 'shelf'])->name('qrcode.shelf');

        Route::post('validate/box-kits', [ValidateController::class, 'box_kits'])->name('validate.box-kits');

        Route::post('validate/box', [ValidateController::class, 'box'])->name('validate.box');
        Route::post('validate/boxes', [ValidateController::class, 'boxes'])->name('validate.boxes');
        Route::post('validate/shelf', [ValidateController::class, 'shelf'])->name('validate.shelf');


        Route::post('validate/kit', [ValidateController::class, 'kit'])->name('validate.kit');
        Route::post('validate/kits/{box}', [ValidateController::class, 'kits'])->name('validate.kits');

        //        Route::get('qrcode/shelf/{shelf}', [QrCodeController::class,'shelf'])->name('qrcode.shelf')

        Route::get('/kit-parts/{kit}/edit', [KitPartController::class, 'edit'])->name('kit-parts.edit');
        Route::patch('/kit-parts/{kit}', [KitPartController::class, 'update'])->name('kit-parts.update');

        Route::get('/kit-parts-update/{kit}/edit', [KitPartUpdateController::class, 'edit'])->name('kit-parts-update.edit');
        Route::patch('/kit-parts-update/{kit}', [KitPartUpdateController::class, 'update'])->name('kit-parts-update.update');
    });


Route::prefix('/admin')->middleware('auth', 'role:admin')->group(function () {
    Route::resource('users', UsersController::class);
});


//Reports
Route::get('/reports/skus',[\App\Http\Controllers\Reports\SkuController::class,'index'])->name('reports.skus');


