<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendor_item extends Model
{
    //

    protected $primaryKey = 'vendor_item_id';

    public function janinfo(){
        return $this->hasOne(jan::class,'jan','jan');
    }
    public function jan()
    {
        return $this->belongsTo(jan::class, 'jan','jan');
    }

    public function stocks()
    {
        return $this->belongsTo(stock_item::class, 'vendor_item_id','vendor_item_id');
    }


}
