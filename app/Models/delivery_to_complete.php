<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class delivery_to_complete extends Model
{
	protected $table = 'delivery_to_complete';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'checkout_id',
		'user_id',
		'created_at',
		'updated_at',
	];

}
