<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\BoxContent;
use App\Models\Kit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ValidateController extends Controller
{

    public function box_kits(Request $request)
    {
        if(Str::substr($request->data, -3) == 'KIT'){
            return $this->kit($request->data);
        }

        if(Str::substr($request->data, 0,3) == 'BOX'){
            return $this->box($request->data);
        }

        return response()->json([
           'err' => 'There are an error with the information',
        ]);
    }
    public function box($data)
    {
        $id = Str::substr($data, 3);
        $box = Box::whereBox_id($id)->first();
        if ($box){
            return response()->json([
                'id' => $box->box_id,
                'type' => 'box',
                'created_at' => $box->created_at
            ]);
        }

        return response()->json(
            'There an error with the Box Information'
        );


    }
    public function kit($data)
    {

        $kit = Kit::where('KitLCN',$data)->first();

        try {
            $exists = BoxContent::where('kit_id',$kit->KitID)->first();
        } catch (Exception $e) {

            return false;
        }


        if ($exists == null) {
            if ($kit){
                return response()->json([
                    'id' => $kit->KitID,
                    'type' => 'kit',
                    'created_at' => $kit->created_at
                ]);
            }
        }


        return response()->json(
            'This Kit Exists on the table',
        );
    }
}
