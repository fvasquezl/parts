<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersHelperController extends Controller
{
    public function GetLCN(Request $request)
    {
        try{
            $lcn = $request->lcn;
            $data = DB::select("EXEC [ord].[sp_GetScannedLCNOrderSKU] '{$lcn}'");

            if($data){
                return response()->json($data[0]);
            }else{
                throw new Exception;
            }

        }catch (Exception $error){
            return response()->json($error->getMessage());
        }
    }
}
