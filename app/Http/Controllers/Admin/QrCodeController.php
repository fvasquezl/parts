<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Kit;
use App\Models\Shelf;
use App\Models\Shelve;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function print(Kit $kit)
    {
        $kitlcn = $kit->KitLCN;
        $brand = $kit->Brand;
        $model  = $kit->Model;

        $parts = $kit->parts()->get()->pluck('PartName')->toArray();
//        $labels=0;
//        $label2=0;
//
//
//        if (count($parts) <= 4){
//            $label1 = $parts;
//        }
//
//        if (count($parts) >4){
//            $label1 = array_slice($parts, 0, 4);
//            array_splice( $parts,0,4);
//            $label2 = $parts;
//        }


        return view('qrcode.print',compact('kitlcn','brand','model','parts'));

    }

    public function box(Box $box)
    {
        return view('qrcode.box',compact('box'));
    }

    public function shelf(Shelf $shelf)
    {
        return view('qrcode.shelf',compact('shelf'));
    }
}
