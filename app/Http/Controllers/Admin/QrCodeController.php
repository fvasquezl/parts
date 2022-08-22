<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Kit $kit)
    {
        $kitlcn = $kit->KitLCN;
        $parts = $kit->parts()->get(['PartName']);
        return view('qrcode.print',compact('kitlcn','parts'));

    }
}
