<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SKUStepsController extends Controller
{
    public function create($brand,$model): Factory|View|Application
    {
        return view('skus.steps.create',[
            'brand' => $brand,
            'model' => $model,
            'countries' => Country::all(),
        ]);
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'brand' => ['required'],
            'model'  => ['required'],
            'country' => ['required'],
            'productVersion'  => ['required'],
            'chasis' => ['required'],
            ]);

        $query = \DB::select("EXEC [PartsProcessing].[prt].[sp_CreateSKUVerifiedPartReferencesStep1]
            '{$request->brand}','{$request->model}','{$request->country}','{$request->productVersion}','{$request->chasis}'
        ")[0];

        return redirect()->route('steps.edit', $query->RefSKU);
    }

    public function edit(Sku $sku): Factory|View|Application
    {
        return view('skus.steps.edit',compact('sku'));
    }

    public function update(Request $request)
    {
        return $request->all();
    }


}
