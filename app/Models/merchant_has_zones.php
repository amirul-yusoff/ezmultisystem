<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class merchant_has_zones extends Model
{
	protected $table = 'merchant_has_zones';

	protected $primaryKey = 'id';

	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'zone_id',
	];
	
	public function getMerchantZone()
    {
        return $this->hasOne('App\Models\user', 'id', 'user_id')
		->where('user_group','=','3');
    }
}
