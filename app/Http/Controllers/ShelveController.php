<?php

namespace App\Http\Controllers;

use App\Models\Shelve;
use Illuminate\Http\Request;

class ShelveController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()){
            $data = Shelve::query();

            return datatables($data)
                ->addIndexColumn()
                ->editColumn('created_at', function($shelf) {
                    return $shelf->getCreatedAt();
                })

                ->addColumn('actions', function(){
                    $btns = '<button class="btn btn-sm btn-success create_btn"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-sm btn-default show-btn"><i class="fas fa-eye"></i></button>';
                    return $btns;
                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->shelf_id;
                })
                ->toJson();
        }

        return view('shelves.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shelve  $shelve
     * @return \Illuminate\Http\Response
     */
    public function show(Shelve $shelve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shelve  $shelve
     * @return \Illuminate\Http\Response
     */
    public function edit(Shelve $shelve)
    {
        return view('shelve.index',$shelve);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shelve  $shelve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shelve $shelve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shelve  $shelve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shelve $shelve)
    {
        //
    }
}
