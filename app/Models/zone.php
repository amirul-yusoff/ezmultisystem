<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zone extends Model
{
	protected $table = 'zone';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'state',
		'city',
		'postcode',
		'zone',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'is_deleted',
	];
	
	public function getUser()
    {
        return $this->hasMany('App\Models\user_has_zones', 'zone_id', 'id');
    }

	public function getMerchant()
    {
        return $this->hasMany('App\Models\merchant_has_zones', 'zone_id', 'id');
    }

	public function getRider()
    {
        return $this->hasMany('App\Models\rider_has_zones', 'zone_id', 'id');
    }
}
