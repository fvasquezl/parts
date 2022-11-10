<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SKUStep1Controller extends Controller
{
    public function index(Request $request)
    {
        $brand =$request->filled('brand')? $request->brand:'';
        $model =$request->filled('model')? $request->model:'';

        return view('skus.step-1.index',compact('brand','model'));
    }
}
