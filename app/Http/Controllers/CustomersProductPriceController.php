<?php

namespace App\Http\Controllers;

use App\CustomersProductPrice;
use Illuminate\Http\Request;

class CustomersProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CustomersProductPrice::updateOrCreate([
            'jan' => $request->jan,
            'customer_id' => $request->customer_id
        ],[
            'jan' => $request->jan,
            'customer_id' => $request->customer_id,
            'price' => $request->price,
        ]);
        return response()->json(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomersProductPrice  $customersProductPrice
     * @return \Illuminate\Http\Response
     */
    public function show(CustomersProductPrice $customersProductPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomersProductPrice  $customersProductPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomersProductPrice $customersProductPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomersProductPrice  $customersProductPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomersProductPrice $customersProductPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomersProductPrice  $customersProductPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomersProductPrice $customersProductPrice)
    {
        //
    }
}
