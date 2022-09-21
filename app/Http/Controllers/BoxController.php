<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()){
            $data = Box::query();
            return datatables($data)
                ->addIndexColumn()
                ->editColumn('box_id', function($box) {
                    return 'BOX'.$box->box_id;
                })
                ->editColumn('date_created', function($box) {
                    return $box->getDateCreated();
                })
                ->editColumn('is_active', function($box) {
                    return $box->getIsActive();
                })

                ->addColumn('actions', function(){
                    $btns = '<button class="qrcode btn btn-sm btn-dark"><i class="fas fa-print"></i></button>
                        <button class="btn btn-sm btn-default show-btn"><i class="fas fa-eye"></i></button>';
                    return $btns;
                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->box_id;
                })
                ->toJson();
        }

        return view('boxes.index');
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
        $box = new Box;
        $box->description= 'Requested At :'. now();;
        $box->is_active = 1;
        $box->save();

        $box->update([
            'box_name' => 'BOX'.$box->box_id
        ]);

        if($request->json()){
            return $box;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit(Box $box)
    {
        return view('boxes.index',$box);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Box $box)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        //
    }
}
