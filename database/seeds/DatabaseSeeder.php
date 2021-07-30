<?php

use App\Coupon;
use App\Discount;
use App\Rule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $coupedFixedCreated = Coupon::create([
            'code' => 'FIXED10',
            'status' => 'available',
        ]);

        $couponPercent = Coupon::create([
            'code' => 'PERCENT10',
            'status' => 'available',
        ]);

        $couponMixed = Coupon::create([
            'code' => 'MIXED10',
            'status' => 'available',
        ]);

        $couponRejected = Coupon::create([
            'code' => 'REJECTED10',
            'status' => 'available'
        ]);


        Rule::create([
            'rule_type' => '>=',
            'amount_limit' => '50',
            'when_to_apply_rule' => 'before',
            'cart_amount_limit' => 1,
            'coupon_id' => $coupedFixedCreated->id
        ]);

        Rule::create([
            'rule_type' => '>=',
            'amount_limit' => '100',
            'when_to_apply_rule' => 'before',
            'cart_amount_limit' => 2,
            'coupon_id' => $couponPercent->id
        ]);

        Rule::create([
            'rule_type' => '>=',
            'amount_limit' => '200',
            'when_to_apply_rule' => 'before',
            'cart_amount_limit' => 3,
            'coupon_id' => $couponMixed->id
        ]);

        Rule::create([
            'rule_type' => '>=',
            'amount_limit' => '1000',
            'when_to_apply_rule' => 'before',
            'cart_amount_limit' => null,
            'coupon_id' => $couponRejected->id
        ]);

        Discount::create([
            'type' => 'mixed',
            'discountAmount' => 10,
            'coupon_id' => $coupedFixedCreated->id
        ]);

        Discount::create([
            'type' => 'percent',
            'discountAmount' => 10,
            'coupon_id' => $couponPercent->id
        ]);

        Discount::create([
            'type' => 'fixed',
            'discountAmount' => 10,
            'coupon_id' => $coupedFixedCreated->id
        ]);

        Discount::create([
            'type' => 'rejected',
            'discountAmount' => 10,
            'coupon_id' => $couponRejected->id
        ]);

    }
}
