<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('events', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name');
				$table->text('description');
				$table->string('location');
				$table->string('speaker');
				$table->dateTime('start_date');
				$table->dateTime('end_date');
				$table->string('image');
				$table->enum('status', ['Upcoming', 'Begins', 'Over']);
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('events');
	}
}
