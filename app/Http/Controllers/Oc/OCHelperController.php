<?php

namespace App\Http\Controllers\Oc;

use App\Http\Controllers\Controller;
use App\Models\Tv;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class OCHelperController extends Controller
{
    public function getTvModels(Request $request)
    {
        $models = Tv::where('brand', $request->data)->select('model')->distinct('model')->orderBy('model', 'asc')->get();
        return response()->json($models);
    }

    public function getOCList(Request $request)
    {

        if ($request->ajax()) {
            if ($request->brand) {
                $brand = $request->brand;
                $model = $request->model;
                $tv = Tv::where('brand', $brand)->where('model', $model)->first();
                $data = DB::select(
                    DB::raw("select * from [PartsProcessing].[oc].[fn_GetOCConfiguredList]('{$tv->id}')")
                );
            } else {
                $data = [];
            }

            return datatables($data)
                ->addIndexColumn()
                ->setRowId(function ($data) {
                    return $data->id;
                })
                ->toJson();
        }
        return false;
    }
}
