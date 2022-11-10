<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Kit;
use App\Models\Sku;
use App\Models\SmartControl;
use App\Models\SubCategory;
use App\Models\WorkCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
     * @throws Exception
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
//            $brand = $request->brandID;
//            $model = $request->modelID;
            $brand = 'Hisense';
            $model = '40H4030F';


            $data = \DB::select("SELECT * FROM [PartsProcessing].[prt].[fn_GetVerifiedPartReferences]('$brand', '$model')");

            return datatables($data)->toJson();
        }

        return view('skus.create', [
            'brands' => Kit::query()->select('Brand')->distinct()->get(),
            'models' => Kit::query()->select('Model')->distinct()->get(),
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
