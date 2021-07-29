<?php

namespace App\Repositories;

use App\Discount;
use App\Repositories\Base\BaseRepository;

class DiscountRepository extends BaseRepository
{
    protected $discountModel;

    public function __construct(Discount $discountModel)
    {
        parent::__construct($discountModel);
    }
}
