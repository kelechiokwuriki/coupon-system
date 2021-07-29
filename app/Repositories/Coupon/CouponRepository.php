<?php

namespace App\Repositories\Coupon;

use App\Coupon;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository
{
    protected $couponModel;

    public function __construct(Coupon $couponModel)
    {
        parent::__construct($couponModel);
    }
}
