<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rider_has_category extends Model
{
	protected $table = 'rider_has_category';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'user_id',
		'category_id',
		'created_at',
		'updated_at',
		'updated_by',
	];

	public function getcategoryName()
	{
		return $this->hasOne('App\Models\rider_category', 'id', 'category_id');
	}
	
}
