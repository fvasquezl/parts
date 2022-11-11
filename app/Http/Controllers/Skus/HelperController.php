<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function getModels(Request $request)
    {
        return \DB::select("SELECT * FROM [PartsProcessing].[prt].[fn_GetVerifiedPartReferencesModels]('$request->text')");
    }
}
