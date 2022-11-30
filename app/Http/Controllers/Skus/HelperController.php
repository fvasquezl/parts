<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use App\Models\KitsData;
use App\Models\Sku;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class HelperController extends Controller
{
    public function getModels(Request $request)
    {
        return \DB::select("SELECT * FROM [PartsProcessing].[prt].[fn_GetVerifiedPartReferencesModels]('$request->text')");
    }

    public function getSkus(Request $request): \Illuminate\Http\JsonResponse
    {

        $data = \DB::select("SELECT * FROM [prt].[fn_GetVerifiedPartReferences] ('$request->brand','$request->model')");
        return datatables($data)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->ref_sku;
            })
            ->toJson();
    }


    public function getKits(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = \DB::select("SELECT * FROM [prt].[fn_GetPartReferencesNonSKU] ('$request->brand','$request->model')");
        return datatables($data)
            ->addIndexColumn()
            ->addColumn('actions', function () {
                $btns = '<button class="btn btn-sm btn-info add-btn"><i class="fas fa-plus-circle"></i></button>';
                return $btns;
            })
            ->rawColumns(['actions'])
            ->setRowId(function ($data) {
                return $data->KitID;
            })
            ->toJson();
    }

    public function getKitsWSku(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = \DB::select("SELECT * FROM [prt].[fn_GetKitData] ('$request->brand','$request->model')");
        return datatables($data)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->kitid;
            })
            ->toJson();
    }


    public function getImages(Sku $sku)
    {
        $images = \DB::select("EXEC [prt].[sp_GetKitSKUImages] '{$sku->ref_sku}'");

        return view('skus.images',compact('images', 'sku'));
    }

    /**
     * @throws Exception
     */
    public function getKitsBySku(Request $request): bool|\Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $data = KitsData::query()->where('ref_sku', '1099')->get();

            return datatables($data)
                ->addIndexColumn()
                ->editColumn('boxname', function ($kit) {
                    if (!$kit->BoxName) {
                        return 'No Box Yet';
                    }
                    return $kit->BoxName;
                })
                ->editColumn('keywords', function ($kit) {
                    if (!$kit->keywords) {
                        return 'No Keywords Yet';
                    }
                    return $kit->keywords;
                })
                ->editColumn('created_at', function ($kit) {
                    return $kit->created_at->toDateTimeString();
                })
                ->setRowId(function ($data) {
                    return $data->kitid;
                })
                ->toJson();
        }
        return false;
    }


}
