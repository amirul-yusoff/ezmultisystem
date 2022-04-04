<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_category extends Model
{
	protected $table = 'user_category';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'description',
		'rate_percentages',
		'created_by',
		'updated_by',
		'create_at',
		'updated_at',
		'category_name'
	];
	
	
}
