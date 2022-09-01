<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $kit = Kit::where('KitLCN',$request->data)->first();

        $request['kit_id'] = $kit->KitID;
        $request->validate([
            "kit_id" => Rule::unique('sqlsrv.bin.BoxContent')
        ]);

            if ($kit){
                return response()->json([
                    'id' => $kit->KitID,
                    'name' => $kit->KitLCN,
                ]);
            }

        return response()->json(
            'There an error with the KIT Information',
        );
    }

}
