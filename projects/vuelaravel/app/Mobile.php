<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model {
	protected $fillable = [
		'title',
		'mobileinformation',
	];
}
