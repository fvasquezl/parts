<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Exceptions\Exception;

class SkusdControllerdd extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
                $data = Sku::query();
            return datatables($data)
                ->addIndexColumn()
                ->addColumn('actions', function () {
                    $btns = '<button class="btn btn-sm btn-default show-btn"><i class="fas fa-eye"></i></button>';
                    return $btns;
                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->id;
                })
                ->toJson();
        }

        return view('skus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $ref_sku = $request->Ref_Sku;

        $kit = Kit::where('KitLCN',$request->KitLCN)->first();
        $firstPart = $kit->parts->first();

        if ($ref_sku !== 'nodata') {

            $result =DB::select("EXEC [PartsProcessing].[prt].[sp_UpdatePartReferencesFromVerified]'$kit->LCN','$ref_sku'")[0];

            if ($result->Success){

                $CablesPart = $kit->parts->where('PartName','Cables')->first();

                return redirect()->route('parts.edit', $CablesPart)
                    ->with('status', 'The Kit and parts has been created, successfully');
            }

        }
         return redirect()->route('parts.edit', $firstPart)
                ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
