<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rider_has_zones extends Model
{
	protected $table = 'rider_has_zones';

	protected $primaryKey = 'id';

	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'zone_id',
	];
	
	public function getRiderZone()
    {
        return $this->hasOne('App\Models\user', 'id', 'user_id')
		->where('user_group','=','4');
    }
}
