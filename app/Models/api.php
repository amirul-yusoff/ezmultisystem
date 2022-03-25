<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class api extends Model
{
	protected $table = 'api';

	protected $primaryKey = 'id';

	public $timestamps = false;

	// protected $fillable = [
	// 	'name',
	// 	'guard_name',
	// 	'created_at',
	// 	'updated_at',
	// 	'created_by',
	// 	'is_deleted',
	// ];

}
