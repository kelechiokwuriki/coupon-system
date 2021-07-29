<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Coupon\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CouponApiController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function processCoupon(Request $request)
    {
        try {
            $response = $this->couponService->processCoupon($request->all());
            return response()->json($response, 200);
        } catch (\Exception $e) {
            Log::error('Unable to process coupon: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to process coupon'], 400);
        }
    }
}
