<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class checkout_to_prepare extends Model
{
	protected $table = 'checkout_to_prepare';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'checkout_id',
		'user_id',
		'created_at',
		'updated_at',
	];

}
