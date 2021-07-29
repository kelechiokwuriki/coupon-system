<?php

namespace App\Repositories\Item;

use App\Item;
use App\Repositories\BaseRepository;

class ItemRepository extends BaseRepository
{
    protected $itemModel;

    public function __construct(Item $itemModel)
    {
        parent::__construct($itemModel);
    }
}
