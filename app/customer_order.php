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
}
