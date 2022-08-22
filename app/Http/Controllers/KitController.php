<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekitRequest;
use App\Http\Requests\UpdatekitRequest;
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

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        if(auth()->user()->role == 'employee'){
            $kits = Kit::where('UserID',auth()->id())->latest()->get();

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
    public function create()
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
     * @param  \App\Http\Requests\StorekitRequest  $request
     * @return RedirectResponse
     */
    public function store(StorekitRequest $request): RedirectResponse
    {
        $kit =$request->createKit();

//        $parts = PartList::select('PartName','IsRequired')
//            ->where('PartCategoryID',$kit->PartCategoryID)
//            ->where('PartSubCategoryID',$kit->PartSubCategoryID)
//            ->get();
//
//        if(count($parts) == 0){
//            return redirect()->route('kits.index')
//                ->with('info', 'The Kit has been created Without Parts');
//        }
//
//        foreach($parts as $part){
//            PartReference::create([
//                'kitID' => $kit->KitID,
//                'PartName' => $part->PartName,
//                'Created' => 0,
//                'IsRequired' => $part->IsRequired,
//                'UserID' =>auth()->id()
//            ]);
//        }
//
//        $firstPart = $kit->parts->first();

        return redirect()->route('kit-parts.edit',$kit)
            ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return Application|Factory|View
     */
    public function show(Kit $kit): View|Factory|Application
    {

        $parts = PartList::select('PartName','IsRequired')
            ->where('PartCategoryID',$kit->PartCategoryID)
            ->where('PartSubCategoryID',$kit->PartSubCategoryID)
            ->get();

//        $parts = PartReference::where('KitID',80)->get();
        return view('kit-part.show',compact('kit','parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kit  $kit
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
     * @param  \App\Http\Requests\UpdatekitRequest  $request
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekitRequest $request, Kit $kit)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        //
    }
}
