<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('products', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('user_id')->nullable();
				$table->string('name')->nullable();
				$table->string('category')->nullable();
				$table->string('price')->nullable();
				$table->integer('sold')->default('0');
				$table->string('image')->nullable();
				$table->text('description')->nullable();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products');
	}
}
