<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
