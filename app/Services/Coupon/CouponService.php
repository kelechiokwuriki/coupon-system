<?php

namespace App\Services\Coupon;

use App\Discount;
use App\Repositories\Coupon\CouponRepository;
use App\Repositories\Rule\RuleRepository;
use App\Repositories\Discount\DiscountRepository;
use Exception;
use Illuminate\Support\Facades\Log;

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


        if (!$coupon || $coupon->status !== 'available') {
            throw new Exception('Coupon is not valid');
        }

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
                }

                $cartTotalAmount = $this->applyDiscount($discount, $cartTotalAmount);
            }
            break;

            case 'after': {
                // apply discount
                $cartTotalAmount = $this->applyDiscount($discount, $cartTotalAmount);

                if ($this->amountComparator($cartTotalAmount, $totalAmountLimit, $ruleType)) {
                    $ruleSuccess = true;
                }
            }
            break;

            default:
                throw new Exception('Unrecognied time to apply rule. Should be before or after discount.');
        }

        if ($cartAmountLimit !== NULL) {
            // process cart amount rule last.
            if ($cartTotalNumberOfItems >= $cartAmountLimit) {
                $ruleSuccess = true;
            } else {
                throw new Exception('Coupon code did not pass rule!!');
            }
        }

        // $coupon->status = 'unavailable';
        // $coupon->save();

        return [
            'coupon_accepted' => $ruleSuccess ? true : false,
            'cartTotalAmount' => $cartTotalAmount
        ];
    }

    private function applyDiscount(Discount $discount, $cartTotal)
    {
        switch ($discount->type) {
            case 'fixed': {
                $cartTotal -= $discount->discountAmount;
            }
            break;

            case 'percent': {
                $cartDeduction = ($discount->discountAmount / 100) * $cartTotal;
                $cartTotal -= $cartDeduction;
            }
            break;

            case 'mixed': {
                $fixedTotalAmount = $cartTotal - $discount->discountAmount;

                $cartDeduction = ($discount->discountAmount / 100) * $cartTotal;
                $percentageTotalAmount = $cartTotal - $cartDeduction;

                $cartTotal = $fixedTotalAmount > $percentageTotalAmount ? $fixedTotalAmount : $percentageTotalAmount;
            }
            break;

            case 'mixed': {
                $fixedTotalAmount = $cartTotal - $discount->discountAmount;

                $cartDeduction = ($discount->discountAmount / 100) * $cartTotal;
                $percentageTotalAmount = $cartTotal - $cartDeduction;

                $cartTotal = $fixedTotalAmount > $percentageTotalAmount ? $fixedTotalAmount : $percentageTotalAmount;
            }
            break;

            case 'rejected': {
                $fixedTotalAmount = $cartTotal - $discount->discountAmount;

                $cartDeduction = ($discount->discountAmount / 100) * $fixedTotalAmount;
                $cartTotal = $cartTotal - $cartDeduction;
            }
            break;

            default:
                throw new Exception('Discount type not recognized');
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
                } else {
                    throw new Exception('Coupon code did not pass rule. Cart total amount is not greater
                    than or equals to set cart total amount rule.');
                }
            }
            break;

            case '<=': {
                if ($amount <= $compareTo) {
                    $passCheck = true;
                } else {
                    throw new Exception('Coupon code did not pass rule. Cart total amount is not less than
                    than or equals to set cart total amount rule.');
                }
            }
            break;

            default:
                throw new Exception('Unrecognized rule type');

        }

        return $passCheck;
    }
}


