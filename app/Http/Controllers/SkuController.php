<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Kit;
use App\Models\Sku;
use App\Models\SmartControl;
use App\Models\SubCategory;
use App\Models\WorkCenter;
use Aws\Result;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Exceptions\Exception;

class SkuController extends Controller
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
                ->editColumn('image_count', function(Sku $sku){
                    return '<a href="/sku/images/'.$sku->ref_sku.'" class="btn btn-info btn-block" target="_blank">
                            <i class="fas fa-images"></i>&nbsp;&nbsp;&nbsp;'.$sku->image_count.'</a>';
                })
                ->editColumn('kits_count', function(Sku $sku){
                    return '<button class="btn btn-secondary btn-block kits-count">
                            <i class="fas fa-fw fa-layer-group"></i>&nbsp;&nbsp;&nbsp;'.$sku->qty.'</button>';
                })
                ->rawColumns(['image_count','kits_count'])
                ->setRowId(function ($data) {
                    return $data->ref_sku;
                })
                ->toJson();
        }

        return view('skus.index');
    }


    /**
     * @throws Exception
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $brand = Str::upper($request->brand);
            $model = Str::upper($request->model);

            $data = \DB::select("SELECT * FROM [PartsProcessing].[prt].[fn_GetVerifiedPartReferences]('$brand', '$model')");

            return datatables($data)->toJson();
        }

        return view('skus.create', [
            'brands' => Kit::query()->select('Brand')->distinct()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

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
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $delete = \DB::select("EXEC [prt].[sp_NukeRefSKU]'{$id}'")[0];

            if ($delete->Result != '1'){
            return response()->json([
                'success' => false
                ]);
            };

        } catch (Exception $e) {

            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }

        return response()->json([
            'success' => 'The sku has been deleted successfully',
        ], 200);

    }



}
