<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rule;
use App\Discount;


class Coupon extends Model
{
    protected $guarded = [];

    public function rule()
    {
        return $this->hasOne(Rule::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
}
