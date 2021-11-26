<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_order extends Model
{
    //
    protected $table = 'customer_orders';

    public function order_details() {
        return $this->hasOne(customer_order_detail::class,'customer_order_id','customer_order_id')
            ->with(['customer_shipment','vendor_item','jans']);
    }

    public function customer()
    {
        return $this->hasOne(customer::class,'customer_id','customer_id');
    }

    public function customer_shop()
    {
        return $this->hasOne(customer_shop::class,'customer_shop_id','customer_shop_id');
    }
}
