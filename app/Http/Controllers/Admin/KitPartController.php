<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kit;
use App\Models\PartList;
use App\Models\PartReference;
use Illuminate\Http\Request;

class KitPartController extends Controller
{


    public function edit(Kit $kit)
    {
        $parts = PartList::select('PartName','IsRequired')
            ->where('PartCategoryID',$kit->PartCategoryID)
            ->where('PartSubCategoryID',$kit->PartSubCategoryID)
            ->get();

//        $parts = PartReference::where('KitID',80)->get();
        return view('admin.kitparts.edit',compact('kit','parts'));

    }

    public function update(Request $request, Kit $kit)
    {
        $request->validate([
            'parts' => 'required|array|min:1'
        ]);

        $partlist = PartList::select('PartName','IsRequired')
            ->where('PartCategoryID',$kit->PartCategoryID)
            ->where('PartSubCategoryID',$kit->PartSubCategoryID)
            ->get()->mapWithKeys(function($item){
                return [$item['PartName'] => $item['IsRequired']];
            })->toArray();


        $kit->parts()->delete();

       foreach ($request->parts as $partname => $value){

           $kit->parts()->create([
               'PartName' => $partname,
               'Created' => 0,
               'IsRequired' => $partlist[$partname],
               'UserID' =>auth()->id()
           ]);
       }
        $firstPart = $kit->parts->first();

        return redirect()->route('parts.edit',$firstPart)
            ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');;

    }

}
