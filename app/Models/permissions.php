<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
	protected $table = 'permissions';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'name',
		'guard_name',
		'created_at',
		'updated_at',
		'created_by',
		'is_deleted',
	];
}
