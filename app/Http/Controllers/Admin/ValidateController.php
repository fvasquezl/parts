<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function box(Request $request)
    {
        $box = $request->mbox;
        $response = true;

        try {
            $box = Box::where('box_id',$box)->first();
        } catch(\Illuminate\Database\QueryException $ex){
            $response = $ex->getMessage();
        }

         return $response;

//        if($request->json()){
//            return $response;
//        }
    }
}
