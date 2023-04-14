<?php

namespace App\Http\Controllers\SkusMaster;

use App\Http\Controllers\Controller;
use App\Models\SKUCompatibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkuMasterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

                $data = SKUCompatibility::query();

            return datatables($data)
                ->addIndexColumn()
                ->addColumn('actions', function () {
                    $btns ='<div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-default show-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns.'</div>';
                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->id;
                })
                ->toJson();
        }

        return view('skuMaster.index');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $skus = $request->data['skus'];
            $msSku = $request->data['MSku'];
            foreach ($skus as $sku){
                $data = DB::select("EXEC [PartsProcessing].[prt].[sp_Create_RefSkuComptability] '{$sku}','{$msSku}',''");
            }
            return response()->json(['success' => 'The SKUMaster has been update successfully'], 200);
        }
        return false;
    }
}
