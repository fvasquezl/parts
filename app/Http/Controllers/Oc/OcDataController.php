<?php

namespace App\Http\Controllers\Oc;

use App\Http\Controllers\Controller;
use App\Models\OCConfigList;
use App\Models\Tv;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OcDataController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = OCConfigList::query();

            return datatables($data)
                ->addIndexColumn()

                ->addColumn('actions', function () {
                  return '<div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-default show-btn"><i class="fas fa-eye"></i></a></div>';
                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->tv_id;
                })
                ->toJson();
        }

        return view('oc.index');
    }

    public function create()
    {
        $brands = Tv::select('brand')->distinct('brand')->orderBy('brand', 'asc')->get();
        $mitSkus = DB::select(
            DB::raw("SELECT * FROM [PartsProcessing].[oc].[fn_GetOCSKUs] ()"));

        return view('oc.create',compact('brands','mitSkus'));
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        Debugbar::info($request->all());

        $this->validate($request,[
            "brand" => "required",
            "model" => "required",
            "partNumber" => "required",
            "mitSku" => "required",
            "instructions" => "sometimes",
            "assemblyGuide" => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);


//        $file = $request->file('assemblyGuide');
//        $name = $file->getClientOriginalName();
//        $path = $request->mitSku.'/'.$name;
        return response()->json('success',200);

//Storage::disk('sftp')->put($path, fopen($request->file('assemblyGuide'), 'rw+'));




//        if ($request->ajax()) {
//            try {
//                $updated= \DB::update("EXEC [prt].[sp_UpdatetVerifiedPartReferencesSKU]'{$sku}','{$request->sku["country_manufactured"]}','{$request->sku["chasis"]}','{$request->sku["product_version_number"]}','{$request->sku["opencell_sku"]}','{$request->sku["opencell_manufacturer"]}','{$request->sku["opencell_partref1"]}','{$request->sku["opencell_partref2"]}','{$request->sku["opencell_partref3"]}','{$request->sku["opencell_partref4"]}','{$request->sku["opencell_partref5"]}','{$request->sku["mainboard_partref1"]}','{$request->sku["mainboard_partref2"]}','{$request->sku["mainboard_partref3"]}','{$request->sku["mainboard_partref4"]}','{$request->sku["mainboard_partref5"]}','{$request->sku["powersupply_partref1"]}','{$request->sku["powersupply_partref2"]}','{$request->sku["powersupply_partref3"]}','{$request->sku["powersupply_partref4"]}','{$request->sku["powersupply_partref5"]}','{$request->sku["tconboard_partref1"]}','{$request->sku["tconboard_partref2"]}','{$request->sku["tconboard_partref3"]}','{$request->sku["tconboard_partref4"]}','{$request->sku["tconboard_partref5"]}','{$request->sku["irsensor_partref1"]}','{$request->sku["irsensor_partref2"]}','{$request->sku["irsensor_partref3"]}','{$request->sku["irsensor_partref4"]}','{$request->sku["irsensor_partref5"]}','{$request->sku["bluetoothmodule_partref1"]}','{$request->sku["bluetoothmodule_partref2"]}','{$request->sku["bluetoothmodule_partref3"]}','{$request->sku["bluetoothmodule_partref4"]}','{$request->sku["bluetoothmodule_partref5"]}','{$request->sku["wifimodule_partref1"]}','{$request->sku["wifimodule_partref2"]}','{$request->sku["wifimodule_partref3"]}','{$request->sku["wifimodule_partref4"]}','{$request->sku["wifimodule_partref5"]}'");
//
//                if($updated){
//                    return response()->json('The Sku has been updated');
//                }else{
//                    throw new Exception;
//                }
//            }catch (Exception $e){
//                return false;
//            }
//        }
//        return false;

//        return response()->json('The information has been saved',200);
    }
}
