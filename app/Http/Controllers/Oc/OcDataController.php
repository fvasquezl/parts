<?php

namespace App\Http\Controllers\Oc;

use App\Http\Controllers\Controller;
use App\Http\Requests\OCConfigRequest;
use App\Models\OCConfig;
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


    public function show($id){
        $ocConfig = \DB::select(
            DB::raw("SELECT *FROM [oc].[fn_GetOCConfiguredItem] ('{$id}')")
        )[0];

        $ocAccessories = DB::select(
            DB::raw("SELECT *FROM [oc].[fn_GetOCAccessoriesList] ('{$id}')")
        );

        $ocConfig = collect($ocConfig);

        $ocAccessories = collect($ocAccessories)->map(function ($v) {
            return (object) $v;
        });

        return view("oc.show",compact('ocConfig','ocAccessories'));
    }



    public function create()
    {
        $brands = Tv::select('brand')->distinct('brand')->orderBy('brand', 'asc')->get();
        $mitSkus = DB::select(
            DB::raw("SELECT * FROM [PartsProcessing].[oc].[fn_GetOCSKUs] ()"));

        return view('oc.create', compact('brands', 'mitSkus'));
    }

    public function store(OCConfigRequest $request): \Illuminate\Http\JsonResponse
    {
        Debugbar::info($request->all());

        $tv = Tv::select('id')->where('brand', $request->brand)->where('model', $request->model)->first();
        $rowInserted = \DB::scalar("EXEC [oc].[sp_Create_OCConfig]$tv->id, $request->partNumber, '{$request->mitSku}', '{$request->instructions}',''");


        if ($request->file('assemblyGuide')) {
            $file = $request->file('assemblyGuide');
            $extension = $file->getClientOriginalExtension();
            $name = $rowInserted . '-assemblyguide.' . $extension;
            $path = $rowInserted;
            $link = Storage::disk('sftp')->putFileAs($path, $file, $name);

            $occonfig = OCConfig::where('id', $rowInserted)->first();
            $occonfig['attachments'] = "http://part-storage.mitechnologiesinc.com/" . $link;
            $occonfig->update();
        }
        return response()->json([
                'status' => 200,
                'message' => 'The OcConfig has been saved successfully',
                'data' => [
                    'accessory_id' => $rowInserted
                ]
            ]);

    }

    public function update(Request $request,$id)
    {
        return response()->json($request->brand);

    //    $tv = Tv::select('id')->where('brand', $request->brand)->where('model', $request->model)->first();

  //      $rowInserted = \DB::scalar("EXEC [oc].[sp_Update_OCConfig]$id,$tv->id, $request->partNumber, '{$request->mitSku}', '{$request->instructions}',''");


//        if ($request->file('assemblyGuide')) {
//            $file = $request->file('assemblyGuide');
//            $extension = $file->getClientOriginalExtension();
//            $name = $rowInserted . '-assemblyguide.' . $extension;
//            $path = $rowInserted;
//            $link = Storage::disk('sftp')->putFileAs($path, $file, $name);
//
//            $occonfig = OCConfig::where('id', $rowInserted)->first();
//            $occonfig['attachments'] = "http://part-storage.mitechnologiesinc.com/" . $link;
//            $occonfig->update();
//        }
//        return response()->json([
//            'status' => 200,
//            'message' => 'The OcConfig has been updated successfully',
//            'data' => [
//                'accessory_id' => $rowInserted
//            ]
//        ]);


    }
}
