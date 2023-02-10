<?php

namespace App\Http\Controllers\Oc;

use App\Http\Controllers\Controller;
use App\Models\OCConfigList;
use App\Models\OCData;
use App\Models\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

}
