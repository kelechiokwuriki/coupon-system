<?php

namespace App\Services;

use App\Coupon;
use App\Discount;
use App\Repositories\CouponRepository;
use App\Repositories\RuleRepository;
use App\Repositories\DiscountRepository;
use Exception;

class CouponService
{
    protected $couponRepository;
    protected $discountRepository;
    protected $ruleRepository;

    public function __construct(CouponRepository $couponRepository,
    DiscountRepository $discountRepository, RuleRepository $ruleRepository)
    {
        $this->couponRepository = $couponRepository;
        $this->discountRepository = $discountRepository;
        $this->ruleRepository = $ruleRepository;
    }

    public function processCoupon(array $couponData)
    {
        $coupon = $this->couponRepository->where('code', $couponData['code'])->first();
        $couponId = $coupon->id;

        $rule = $this->ruleRepository->where('coupon_id', $couponId)->first();
        $discount = $this->discountRepository->where('coupon_id', $couponId)->first();

        $ruleType = $rule->rule_type;
        $totalAmountLimit = $rule->amount_limit;
        $cartAmountLimit = $rule->cart_amount_limit;
        $whenToApplyRule = $rule->when_to_apply_rule;

        $cartTotalAmount = $couponData['cartTotalAmount'];
        $cartTotalNumberOfItems = $couponData['cartTotalNumberOfItems'];

        // $cartTotalAmountLimitCheckPassed = false; // if cart total is >, <, = totalAmountLimit e.g 100
        $ruleSuccess = false;

        switch ($whenToApplyRule) {
            case 'before': { //before discount
                if ($this->amountComparator($cartTotalAmount, $totalAmountLimit, $ruleType)) {
                    $ruleSuccess = true;
                } else {
                    throw new Exception('Coupon code did not pass rule');
                }
            }

            case 'after': {
                // apply discount
                $newTotalAfterDiscountApplied = $this->applyDiscount($discount, $cartTotalAmount);

                if ($this->amountComparator($newTotalAfterDiscountApplied, $totalAmountLimit, $ruleType)) {
                    $ruleSuccess = true;
                } else {
                    throw new Exception('Coupon code did not pass rule');
                }

            }
        }

        // process cart amount rule last.
        if ($cartTotalNumberOfItems >= $cartAmountLimit) {
            $ruleSuccess = true;
        } else {
            throw new Exception('Coupon code did not pass rule');
        }

        $coupon->status = 'unavailable';
        $coupon->save();

        return [
            'coupon_accepted' => $ruleSuccess ? true : false
        ];
    }

    private function applyDiscount(Discount $discount, $cartTotal)
    {
        switch ($discount->type) {
            case 'fixed_amount': {
                $cartTotal -= $discount->discountAmount;
            }
            break;

            case 'percent_off': {
                $cartDeduction = ($discount->discountAmount / 100) * $cartTotal;
                $cartTotal -= $cartDeduction;
            }
        }

        return $cartTotal;
    }

    private function amountComparator($amount, $compareTo, $comparison)
    {
        $passCheck = false;

        switch ($comparison) {
            case '>=': {
                if ($amount >= $compareTo) {
                    $passCheck = true;
                }
            }
            break;

            case '<=': {
                if ($amount <= $compareTo) {
                    $passCheck = true;
                }
            }
            break;

            default:
                throw new Exception('Unrecognized rule type');

        }

        return $passCheck;
    }
}


