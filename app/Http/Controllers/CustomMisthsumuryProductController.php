<?php

namespace App\Http\Controllers;

use App\CustomMisthsumuryProduct;
use App\jan;
use App\vendor;
use App\vendor_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomMisthsumuryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Custom Mitsumury";
        $active = 'custom-mitsumury';
        return view('backend.handy_pages.custom-mitsumury', compact('title', 'active'));
    }


    public function getAllMistumury()
    {
        $products = CustomMisthsumuryProduct::orderBy('created_at','desc')->get();
        return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->image;
        $extension = $image->extension();
        $name = pathinfo($image->getClientOriginalName(),PATHINFO_FILENAME).time().mt_rand();
        $vendor = vendor::where('user_id',auth()->id())->first();
        $jan = rand(1000000000,9999999999);
        $jan = '20'. $vendor->vendor_id . $jan;
        $image->storeAs('/public', $name .".".$extension);

        CustomMisthsumuryProduct::create([
            'name' => $request->title,
            'jan' => $jan,
            'vendor_id' => $vendor->vendor_id,
            'vendor_name' => $vendor->name,
            'cost_price' => $request->cost,
            'selling_price' => $request->sell,
            'gross_profit' => $request->sell - $request->cost,
            'gross_profit_margin' => $request->profit_margin,
            'case_unit' => 24,
            'ball_unit' => 6,
            'image' => $name .".".$extension
        ] );

        jan::updateOrinsert(["jan" => $jan],[
            "jan" => $jan,
            "name" => $request->title,
            "case_inputs" => 24,
            "ball_inputs" => 6,
            "jan_start_date" => date('Y-m-d H:i:s'),
            "jan_end_date" => date('Y-m-d H:i:s'),
        ]);

        $vendor_data_ins_array = array(
            'maker_id' => 0,
            'vendor_id' =>  auth()->id(),
            'jan' => $jan,
            'cost_price' => $request->cost,
            'sale_cost_price' => $request->sell,
            'selling_price' => $request->sell,
            'gross_profit' => $request->sell - $request->cost,
            'gross_profit_margin' => $request->profit_margin,
            "start_date" => now(),
        );

        vendor_item::updateOrInsert(['jan' => $jan],$vendor_data_ins_array);

        return response()->json(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CustomMisthsumuryProduct $customMisthsumuryProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CustomMisthsumuryProduct $customMisthsumuryProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CustomMisthsumuryProduct $customMisthsumuryProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomMisthsumuryProduct $customMisthsumuryProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CustomMisthsumuryProduct $customMisthsumuryProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomMisthsumuryProduct $customMisthsumuryProduct)
    {
        $custom_estimate_item = $customMisthsumuryProduct->find($request->id);
        $custom_estimate_item->cost_price = $request->cost;
        $custom_estimate_item->selling_price = $request->sell;
        $custom_estimate_item->gross_profit = $request->sell - $request->cost;
        $custom_estimate_item->gross_profit_margin = $request->gross_profit_margin;
        $custom_estimate_item->save();

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CustomMisthsumuryProduct $customMisthsumuryProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomMisthsumuryProduct $customMisthsumuryProduct)
    {
        //
    }
}
