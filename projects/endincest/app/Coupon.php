<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
	protected $fillable = [
		'code', 'type', 'value', 'percent_off'
	];

}
