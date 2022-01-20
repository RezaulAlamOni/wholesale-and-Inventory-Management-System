<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\estimate_item;

class jan extends Model
{
    //
    public function jan_estimate(){
        return $this->belongsTo(estimate_item::class,'jan','jan');
    }

    public function custom_mistumury() {
        return $this->hasOne(CustomMisthsumuryProduct::class,'jan','jan');
    }
}
