<?php

namespace App\Http\Controllers;

use App\customer_item;
use App\CustomMisthsumuryProduct;
use App\jan;
use App\vendor;
use App\vendor_item;
use App\CustomersProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use thiagoalessio\TesseractOCR\TesseractOCR;


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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mistumuryOrders()
    {
        $title = "Custom Mitsumury Orders";
        $active = 'custom-mitsumury Orders';
        return view('backend.handy_pages.custom-mitsumury-orders', compact('title', 'active'));
    }

    public function customMistumuryShipment()
    {
        $title = "Custom Mitsumury Shipment";
        $active = 'custom-mitsumury Shipment';
        return view('backend.handy_pages.custom-mitsumury-orders-shipment', compact('title', 'active'));
    }


    public function getAllMistumury()
    {
        $products = CustomMisthsumuryProduct::orderBy('created_at','desc')->with('customer_prices')->get();
        $customer_prices = CustomersProductPrice::groupBy('customer_id')->orderBy('price','asc')->orderby('id','desc')->get();
        return response()->json(['products' => $products,'customer_prices' => $customer_prices]);
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

//        $image->storeAs('/public', $name .".".$extension);
        $fileNameToStore = $name .".".$extension;
        $file = $request->file('image');

//        $resize = Image::make($file)->resize(300, null, function ($constraint) {
//            $constraint->aspectRatio();
//        })->encode('jpg');
        $resize = Image::make($file)->encode('jpg');

        // Create hash value
//        $hash = md5($resize->__toString());

        // Prepare qualified image name
//        $image = $hash."jpg";

        // Put image to storage
        $save = Storage::put("public/{$fileNameToStore}", $resize->__toString());

        $vendor = vendor::where('user_id',auth()->id())->first();
        $jan = rand(1000000000,9999999999);
        $jan = '20'. $vendor->vendor_id . $jan;

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
            'vendor_id' =>  $vendor->vendor_id ,
            'jan' => $jan,
            'cost_price' => $request->cost,
            'sale_cost_price' => $request->sell,
            'selling_price' => $request->sell,
            'gross_profit' => $request->sell - $request->cost,
            'gross_profit_margin' => $request->profit_margin,
            "start_date" => now(),
        );

        vendor_item::updateOrInsert(['jan' => $jan],$vendor_data_ins_array);

        $cost_price  =  $request->cost+  30;
        $selling_price =  $request->cost + (( $request->cost * 30) / 100);
        $customer_data_ins_array = array(
            'customer_id' => 0,
            'vendor_id' => $vendor->vendor_id,
            'jan' => $jan,
            'cost_price' => $cost_price,
            'selling_price' => $selling_price,
            'gross_profit' => (($cost_price * 30) / 100)
//                'gross_profit' => $item->selling_price - $item->cost_price
        );
        customer_item::updateOrInsert(['jan' => $jan], $customer_data_ins_array);
        try {
            $txt = (new TesseractOCR('public/storage/'.$fileNameToStore))
                ->lang('eng')
                ->run();
        } catch (\Exception $exception) {
            $txt = $exception->getMessage();
        }

        return response()->json(['status' => 200,'jan' => $jan,'ocr-txt' => $txt]);
    }

    public function delete(Request $request)
    {
        $jans = $request->jan;
        foreach ($jans as $jan) {
            $custom_product = CustomMisthsumuryProduct::where('jan' , $jan)->first();
            $path = base_path().'/'.$custom_product->image;

            CustomMisthsumuryProduct::where('jan' , $jan)->delete();
            jan::where('jan' , $jan);
            vendor_item::where('jan' , $jan)->delete();
            customer_item::where('jan' , $jan)->delete();
            if(File::exists($path)) {
                File::delete($path);
            }
        }

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
        if (isset($request->title)) {
            CustomMisthsumuryProduct::query()->where( 'jan', $request->jan)->update([
                'name' => $request->title,
                ]);
            return response()->json(['status' => 200]);
        }
        $custom_estimate_item = $customMisthsumuryProduct->find($request->id);
        $custom_estimate_item->cost_price = $request->cost;
        $custom_estimate_item->case_unit = $request->case_qty;
        $custom_estimate_item->ball_unit = $request->ball_qty;
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
