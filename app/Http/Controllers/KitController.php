<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekitRequest;
use App\Http\Requests\UpdatekitRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Kit;
use App\Models\SubCategory;
use App\Models\WorkCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kits = Kit::latest()->paginate(10);

        return view('kits.index',compact('kits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
        return redirect()
            ->route('kits.index')
            ->with('status', 'The Kit has been created successfully');
//        return redirect()->route('kits.edit', $kit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(kit $kit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(kit $kit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekitRequest  $request
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekitRequest $request, kit $kit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(kit $kit)
    {
        //
    }
}
