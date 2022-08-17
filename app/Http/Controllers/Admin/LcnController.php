<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LcnController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->text)){
            return response()->json([
                'fields'=> $this->getFields($request->text),
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function getFields($text): array
    {
        $query = \DB::select("SELECT Brand, Model FROM [PartsProcessing].[prt].[sp_GetLCNData]('$text')")[0];

        return $fields = [
            'partsLcn'=> strtoupper($text.'-KIT'),
            'brand' => strtoupper($query->Brand),
            'model' => strtoupper($query->Model),
        ];
    }
}
