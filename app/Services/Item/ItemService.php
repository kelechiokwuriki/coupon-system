<?php

namespace App\Services\Item;

use App\Repositories\Item;
use App\Repositories\Item\ItemRepository;

class ItemService
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getAllItems()
    {
        return $this->itemRepository->all();
    }
}
