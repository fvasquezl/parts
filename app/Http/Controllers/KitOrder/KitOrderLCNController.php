<?php

namespace App\Http\Controllers\KitOrder;

use App\Http\Controllers\Controller;
use App\Models\KitOrder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KitOrderLCNController extends Controller
{
    public function edit(KitOrder $kitOrder): Factory|View|Application
    {
        return view('kitOrderLCN.edit', compact('kitOrder'));
    }
}
