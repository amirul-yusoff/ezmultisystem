<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rider_category extends Model
{
	protected $table = 'rider_category';

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
