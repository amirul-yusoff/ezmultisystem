<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zone extends Model
{
	protected $table = 'zone';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'state',
		'city',
		'postcode',
		'zone',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'is_deleted',
	];
}
