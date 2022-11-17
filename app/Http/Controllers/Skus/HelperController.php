<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getModels(Request $request)
    {
        return \DB::select("SELECT * FROM [PartsProcessing].[prt].[fn_GetVerifiedPartReferencesModels]('$request->text')");
    }

    public function getSkus(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = \DB::select("SELECT * FROM [prt].[fn_GetVerifiedPartReferences] ('LG','55UQ7070ZUE')");
        return datatables($data)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->ref_sku;
            })
            ->toJson();

    }


    public function getKits(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = \DB::select("SELECT * FROM [prt].[fn_GetPartReferencesNonSKU] ('LG','55UQ7070ZUE')");
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
}
