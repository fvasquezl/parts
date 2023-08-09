<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderFulfillmentController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }
}
