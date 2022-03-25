<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class has_address extends Model
{
	protected $table = 'has_address';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'address_1',
		'address_2',
		'city',
		'state',
		'is_default',
		'is_deleted',
		'created_at',
		'updated_at',
		'postcode',
		'country',
		'latitude',
		'user_id',
		'longitude'
	];

}
