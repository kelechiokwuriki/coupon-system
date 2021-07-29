<?php

namespace App\Repositories\Discount;

use App\Discount;
use App\Repositories\BaseRepository;

class DiscountRepository extends BaseRepository
{
    protected $discountModel;

    public function __construct(Discount $discountModel)
    {
        parent::__construct($discountModel);
    }
}
