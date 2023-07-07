<?php

namespace App\Http\Controllers\KitOrder;

use App\Http\Controllers\Controller;
use App\Models\KitOrder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class KitOrderController extends Controller
{

    /**
     * @throws Exception
     */
    public function index(Request $request): View|Factory|JsonResponse|Application
    {
        if ($request->ajax()) {
            $data = KitOrder::query();

            return datatables($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($kit) {
                    return $kit->created_at->toDateTimeString();
                })
                ->addColumn('actions', function () {
                    return  '<div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info qrcode"><i class="fas fa-fw fa-print"></i></a>
                            <a href="#" class="btn btn-default show-btn"><i class="fas fa-eye"></i></a></div>';

                })
                ->rawColumns(['actions'])
                ->setRowId(function ($data) {
                    return $data->kitid;
                })
                ->toJson();

        }
        return view('kitOrder.index');
    }

    public function create(Request $request)
    {
        return view('kitOrder.create');
    }

    public function store(Request $request)
    {

        $kitOrder = new KitOrder;
        $kitOrder->order_status= 'In Process';
        $kitOrder->created_by= $request->user()->id;
        $kitOrder->save();

        if($request->json()){
            return $kitOrder;
        }
        return false;
    }


    public function edit(KitOrder $kitOrder): Factory|View|Application
    {

        return view('kitOrder.edit', compact('kitOrder'));

//
//        $kitOrder = new KitOrder;
//        $kitOrder->order_status= 'In Process';
//        $kitOrder->created_by= $request->user()->id;
//        $kitOrder->save();
//
//        if($request->json()){
//            return $kitOrder;
//        }
//        return false;
    }

}
