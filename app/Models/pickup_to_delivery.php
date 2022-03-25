<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pickup_to_delivery extends Model
{
	protected $table = 'pickup_to_delivery';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'checkout_id',
		'user_id',
		'created_at',
		'updated_at',
	];

}
