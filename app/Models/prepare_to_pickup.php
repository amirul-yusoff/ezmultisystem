<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prepare_to_pickup extends Model
{
	protected $table = 'prepare_to_pickup';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'checkout_id',
		'user_id',
		'created_at',
		'updated_at',
	];

}
