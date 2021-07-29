<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('rule_type'); // can be '>', '<', '='
            $table->double('amount_limit'); //e.g 50
            $table->string('when_to_apply_rule'); // can be before or Discount or after
            $table->unsignedBigInteger('cart_amount_limit'); //contain at least 1 item
            $table->unsignedBigInteger('coupon_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
    }
}
