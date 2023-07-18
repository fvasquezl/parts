<?php

namespace App\Http\Controllers\KitOrder;

use App\Http\Controllers\Controller;
use App\Models\KitOrder;
use App\Models\KitsData;
use App\Models\Sku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Exceptions\Exception;

class KOHelperController extends Controller
{
    /**
     * @throws Exception
     */
    public function getSkus(Request $request): JsonResponse
    {
        $data = Sku::query();
        return datatables($data)
            ->addColumn('id', function ($data) {
                return $data->ref_sku;
            },0)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->ref_sku;
            })
            ->toJson();
    }



    /**
     * @throws Exception
     */
    public function getKits(Request $request): JsonResponse
    {
        $data = KitsData::query();


        return datatables($data)
            ->addColumn('id', function ($data) {
                return $data->kitlcn;
            },0)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->kitid;
            })
            ->toJson();
    }


    public function deleteLCN(Request $request,KitOrder $kitOrder){
        $data =DB::insert("EXEC [PartsProcessing].[prt].[sp_NukeKitOrderLCN] '{$kitOrder->order_id}', '{$request->data['lcn']}'");
        return response()->json(['success' => 'The LCN has been delete successfully'],200);
    }
}
