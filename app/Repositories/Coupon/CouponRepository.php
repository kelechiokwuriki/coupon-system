<?php

namespace App\Repositories;

use App\Coupon;
use App\Repositories\Base\BaseRepository;

class CouponRepository extends BaseRepository
{
    protected $couponModel;

    public function __construct(Coupon $couponModel)
    {
        parent::__construct($couponModel);
    }
}
