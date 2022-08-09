<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartReferenceRequest;
use App\Http\Requests\UpdatePartReferenceRequest;
use App\Models\PartReference;

class PartReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartReferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartReferenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartReference  $partReference
     * @return \Illuminate\Http\Response
     */
    public function show(PartReference $partReference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartReference  $partReference
     * @return \Illuminate\Http\Response
     */
    public function edit(PartReference $partReference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartReferenceRequest  $request
     * @param  \App\Models\PartReference  $partReference
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartReferenceRequest $request, PartReference $partReference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartReference  $partReference
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartReference $partReference)
    {
        //
    }
}
