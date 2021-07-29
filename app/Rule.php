<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Coupon;

class Rule extends Model
{
    protected $guarded = [];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
