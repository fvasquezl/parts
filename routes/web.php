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
use App\Http\Controllers\Oc\OcDataController;
use App\Http\Controllers\PartReferenceController;
use App\Http\Controllers\RemoveInvController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\SkuController;
use App\Http\Controllers\Skus\HelperController;
use App\Http\Controllers\Skus\SKUStepsController;
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


        Route::get('sku/steps/create/{brand}/{model}',[SKUStepsController::class,'create'])->name('steps.create' );
        Route::post('sku/steps',[SKUStepsController::class,'store'])->name('steps.store');
        Route::get('sku/steps/{sku}/edit',[SKUStepsController::class,'edit'])->name('steps.edit');
        Route::patch('sku/steps/{sku}',[SKUStepsController::class,'update'])->name('steps.update');


        Route::resource('boxShelf', BoxShelfController::class)
            ->only([
                'index', 'update','destroy'
            ])
            ->parameters([
            'boxShelf' => 'shelf'
        ]);

        Route::view('/boxesRemove','boxes.delete');
        Route::view('/shelfRemove','shelves.delete');



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

        Route::post('validate/shelfBox/{shelf}', [ValidateController::class, 'shelfBox'])->name('validate.shelfBox');
        //        Route::get('qrcode/shelf/{shelf}', [QrCodeController::class,'shelf'])->name('qrcode.shelf')

        Route::get('/kit-parts/{kit}/edit', [KitPartController::class, 'edit'])->name('kit-parts.edit');
        Route::patch('/kit-parts/{kit}', [KitPartController::class, 'update'])->name('kit-parts.update');

        Route::get('/kit-parts-update/{kit}/edit', [KitPartUpdateController::class, 'edit'])->name('kit-parts-update.edit');
        Route::patch('/kit-parts-update/{kit}', [KitPartUpdateController::class, 'update'])->name('kit-parts-update.update');

        Route::post('/sku/getModels',[HelperController::class,'getModels'])->name('sku.getModels');
        Route::post('/sku/getSKUModels',[HelperController::class,'getSKUModels'])->name('sku.getSKUModels');

        Route::get('/sku/getSkus',[HelperController::class,'getSkus'])->name('sku.getSkus');
        Route::get('/sku/getKits',[HelperController::class,'getKits'])->name('sku.getKits');
        Route::get('/sku/getKitsWSku',[HelperController::class,'getKitsWSku'])->name('sku.getKitsWSku');
        Route::get('/sku/getBulkKitsWSku',[HelperController::class,'getBulkKitsWSku'])->name('sku.getBulkKitsWSku');
        Route::post('/sku/kitBulkUpdate',[HelperController::class,'kitBulkUpdate'])->name('sku.kitBulkUpdate');

        Route::get('/sku/images/{sku}',[HelperController::class,'getImages'])->name('sku.getImages');
        Route::get('/sku/getKitsBySku',[HelperController::class,'getKitsBySku'])->name('sku.getKitsBySku');
        Route::get('/sku/getSkuToKit',[HelperController::class,'getSkuToKit'])->name('sku.getSkuToKit');
        Route::post('/sku/kitUpdate',[HelperController::class,'kitUpdate'])->name('sku.kitUpdate');
        Route::get('/sku/getKitData',[HelperController::class,'getKitData'])->name('sku.getKitData');

        Route::patch('/sku/updateKitData/{sku}',[HelperController::class,'updateKitData'])->name('sku.updateKitData');


        Route::get('/oc',[OCDataController::class,'index'])->name('oc.index');
        Route::get('/oc/create',[OCDataController::class,'create'])->name('oc.create');
    });


Route::prefix('/admin')->middleware('auth', 'role:admin')->group(function () {
    Route::resource('users', UsersController::class);
});


//Reports
Route::get('/reports/skus',[\App\Http\Controllers\Reports\SkuController::class,'index'])->name('reports.skus');


