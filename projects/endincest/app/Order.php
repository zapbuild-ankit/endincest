<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	protected $fillable = [
		'user_id', 'product_id', 'name', 'phone', 'street1', 'street2',
		'city', 'state', 'zip', 'discount', 'discount_type', 'coupon_code', 'payment_method', 'total', 'payment_gateway',
	];

	public function user() {
		return $this->belongsTo('App\User');
	}
}
