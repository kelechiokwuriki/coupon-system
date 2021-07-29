<?php

namespace App\Services;

use App\Repositories\DiscountRepository;

class DiscountService
{
    protected $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function getDiscountsForCoupon(int $couponId)
    {
        return $this->discountRepository->where('coupon_id', $couponId)->get();
    }
}
