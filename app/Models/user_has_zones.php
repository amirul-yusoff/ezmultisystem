<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_has_zones extends Model
{
	protected $table = 'user_has_zones';

	protected $primaryKey = 'id';

	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'zone_id',
	];
	
	public function getUserZone()
    {
        return $this->hasOne('App\Models\user', 'id', 'user_id');
    }
}
