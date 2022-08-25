<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekitRequest;
use App\Http\Requests\UpdatekitRequest;
use App\Http\Resources\KitResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Kit;
use App\Models\PartList;
use App\Models\PartReference;
use App\Models\SubCategory;
use App\Models\WorkCenter;
use http\Client\Curl\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {

        if(auth()->user()->role == 'employee'){
            $kits = KitResource::collection(Kit::where('UserID',auth()->id())->latest()->get());

        }else{
            $kits = Kit::latest()->get();
        };


        return view('kits.index',compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('kits.create',[
            'kit' => new Kit,
            'workCenters' => WorkCenter::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorekitRequest $request
     * @return RedirectResponse
     */
    public function store(StorekitRequest $request): RedirectResponse
    {
        $kit =$request->createKit();

        return redirect()->route('kit-parts.edit',$kit)
            ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');

    }

    /**
     * Display the specified resource.
     *
     * @param Kit $kit
     * @return Application|Factory|View
     */
    public function show(Kit $kit): View|Factory|Application
    {
        $parts = $kit->parts()->orderby('PartName')->get();
        return view('kits.show',compact('kit','parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Kit $kit
     * @return Application|Factory|View
     */
    public function edit(kit $kit): View|Factory|Application
    {
        return view('kits.edit',[
            'kit' => $kit,
            'workCenters' => WorkCenter::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorekitRequest $request
     * @param Kit $kit
     * @return RedirectResponse
     */
    public function update(StorekitRequest $request, Kit $kit): RedirectResponse
    {

        $request->updateKit($kit);

        return redirect()->route('kit-parts-update.edit',$kit)
            ->with('status', 'The Kit has been updated, successfully, now we will update each part that compose it');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Kit $kit
     * @return Response
     */
    public function destroy(Kit $kit)
    {
        //
    }
}
