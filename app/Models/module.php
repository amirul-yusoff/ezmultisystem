<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class module extends Model
{
	protected $table = 'module';

	protected $fillable = [
		'parent_id',
		'module_type',
		'module_name',
		'description',
		'platform',
		'status',
		'url',
		'icon',
		'isdelete'
	];
}
