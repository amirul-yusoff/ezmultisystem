<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_has_category extends Model
{
	protected $table = 'user_has_category';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'user_id',
		'category_id',
		'created_at',
		'updated_at',
		'updated_by',
	];

	public function getusercategoryName()
	{
		return $this->hasOne('App\Models\user_category', 'id', 'category_id');
	}
	
}
