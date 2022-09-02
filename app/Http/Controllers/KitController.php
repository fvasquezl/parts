<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekitRequest;
use App\Http\Requests\UpdatekitRequest;
use App\Http\Resources\KitResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Kit;
use App\Models\PartList;
use App\Models\SubCategory;
use App\Models\WorkCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class KitController extends Controller
{

    public function index(Request $request): View|Factory|\Illuminate\Http\JsonResponse|Application
    {
//        if ($request->json()){  to see rag
        if ($request->ajax()) {
            if (auth()->user()->role == 'employee') {
                $data = Kit::query()->where('UserID', auth()->id())->latest()->get();

            } else {
                $data = Kit::query()->latest()->get();
            };

            return datatables($data)
                ->addIndexColumn()
                ->editColumn('WorkCenter', function ($kit) {
                    return $kit->workCenter->WorkCenterName;
                })
                ->editColumn('DateManufactured', function ($kit) {
                    return $kit->getDateManufactured();
                })
                ->editColumn('CategoryName', function ($kit) {
                    return $kit->category->CategoryName;
                })
                ->editColumn('SubCategoryName', function ($kit) {
                    return $kit->subCategory->SubCategoryName;
                })
                ->editColumn('Country', function ($kit) {
                    return $kit->country->CountryName;
                })
                ->addColumn('Actions', function () {
                    $btns = '<button class="btn btn-sm btn-info qrcode"><i class="fas fa-print"></i></button>
                        <button class="btn btn-sm btn-default show-btn"><i class="fas fa-eye"></i></button>';
                    return $btns;
                })
                ->rawColumns(['Actions'])
                ->setRowId(function ($data) {
                    return $data->KitID;
                })
                ->toJson();
        }

        return view('kits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('kits.create', [
            'kit' => new Kit,
            'workCenters' => WorkCenter::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorekitRequest $request
     * @return RedirectResponse
     */
    public function store(StorekitRequest $request): RedirectResponse
    {
        $kit = $request->createKit();

        $partlist = PartList::select('PartName', 'IsRequired')
            ->where('PartCategoryID', $kit->PartCategoryID)
            ->where('PartSubCategoryID', $kit->PartSubCategoryID)
            ->get()->mapWithKeys(function ($item) {
                return [$item['PartName'] => $item['IsRequired']];
            })->toArray();


        $kit->parts()->delete();

        foreach ($partlist as $partname => $value) {

            $kit->parts()->create([
                'PartName' => $partname,
                'PartWeightOz' => 0,
                'Created' => 0,
                'IsRequired' => $value,
                'UserID' => auth()->id()
            ]);
        }
        $firstPart = $kit->parts->first();

        return redirect()->route('parts.edit', $firstPart)
            ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');;


//        return redirect()->route('kit-parts.update',$kit)
//            ->with('status', 'The Kit has been created, successfully, now we will create each part that compose it');

    }

    /**
     * Display the specified resource.
     *
     * @param Kit $kit
     * @return Application|Factory|View
     */
    public function show(Kit $kit): View|Factory|Application
    {
        $parts = $kit->parts()->orderby('PartName')->get();
        return view('kits.show', compact('kit', 'parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Kit $kit
     * @return Application|Factory|View
     */
    public function edit(kit $kit): View|Factory|Application
    {
        return view('kits.edit', [
            'kit' => $kit,
            'workCenters' => WorkCenter::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorekitRequest $request
     * @param Kit $kit
     * @return RedirectResponse
     */
    public function update(StorekitRequest $request, Kit $kit): RedirectResponse
    {

        $request->updateKit($kit);

        return redirect()->route('kit-parts-update.edit', $kit)
            ->with('status', 'The Kit has been updated, successfully, now we will update each part that compose it');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Kit $kit
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Kit $kit)
    {

        $ret = \DB::select("EXEC [prt].[sp_NukeKit]'$kit->KitLCN';");

        if ($ret) {
            return response()->json([
                'success' => $ret[0]->Exists,
            ], 200);
        } else {
            return response()->json([
                'error' => "There are an error with the KIT",
            ]);
        }
    }
}
