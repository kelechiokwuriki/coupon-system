<?php

namespace App\Services;

use App\Repositories\ItemRepository;

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
