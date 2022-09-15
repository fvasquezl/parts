<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Kit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ValidateController extends Controller
{

    public function box(Request $request)
    {
        $id = Str::substr($request->data, 3);
        $box = Box::whereBox_id($id)->first();
        if ($box){
            return response()->json([
                'id' => $box->box_id,
                'name' => 'BOX'.$box->box_id,
            ]);
        }
        return response()->json(
            'There an error with the BOX Information'
        );
    }

    public function kit(Request $request)
    {
        if(Str::substr($request->data,-4) !== '-KIT'){
             $request->data = $request->data.'-KIT';
        };

        try {
            $kit = Kit::where('KitLCN',$request->data)->first();
        } catch (Exception $e) {

            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }


        return response()->json([
            'id' => $kit->KitID,
            'name' => $kit->KitLCN,
        ]);

//
//        if ($kit){
//
//        }
//
//        return response()->json(
//            'There an error with the KIT Information',
//        );
    }

}
