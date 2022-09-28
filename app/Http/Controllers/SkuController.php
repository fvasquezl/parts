<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\PartReference;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        return view('skus.index',[
            'skus' => DB::select("EXEC [PartsProcessing].[prt].[sp_GetVerifiedPartReferences]'$request->LCN'")
        ]);
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

        $result =DB::select("EXEC [PartsProcessing].[prt].[sp_UpdatePartReferencesFromVerified]'$kit->LCN','$ref_sku'")[0];

        $firstPart = $kit->parts->first();

        if ($result->Success){
            return redirect()->route('kits.index')
                ->with('status', 'The Kit and parts has been created, successfully');
        }else{
            return redirect()->route('parts.edit', $firstPart)
                ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');

        }


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
