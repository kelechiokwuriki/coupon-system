<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Item\ItemService;
use Illuminate\Support\Facades\Log;

class ItemApiController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $items = $this->itemService->getAllItems();
            return response()->json($items, 200);
        } catch (\Exception $e) {
            Log::error("Unable to get all items: " . $e->getMessage());
            return response()->json(['error' => 'Unable to get all items'], 500);
        }
    }
}
