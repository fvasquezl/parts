<?php

namespace App\Http\Controllers\KitOrder;

use App\Http\Controllers\Controller;
use App\Models\KitsData;
use App\Models\Sku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                return $data->kitid;
            },0)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->kitid;
            })
            ->toJson();
    }
}
