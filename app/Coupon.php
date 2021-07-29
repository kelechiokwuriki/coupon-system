<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rule;
use App\Discount;


class Coupon extends Model
{
    protected $guarded = [];

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
