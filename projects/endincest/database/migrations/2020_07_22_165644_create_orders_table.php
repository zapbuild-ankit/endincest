<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orders', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('user_id')->nullable();
				$table->integer('product_id')->nullable();
				$table->string('name')->nullable();
				$table->string('street1')->nullable();
				$table->string('street2')->nullable();
				$table->string('city')->nullable();
				$table->string('state')->nullable();
				$table->string('zip')->nullable();
				$table->string('phone')->nullable();
				$table->string('coupon_code')->nullable();
				$table->string('discount_type')->nullable();
				$table->string('discount')->nullable();
				$table->string('payment_method')->nullable();
				$table->string('payment_geteway')->nullable();
				$table->string('total')->nullable();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('orders');
	}
}
