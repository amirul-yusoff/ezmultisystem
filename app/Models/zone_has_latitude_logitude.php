<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zone_has_latitude_logitude extends Model
{
	protected $table = 'zone_has_latitude_logitude';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'zone_id',
		'latitude',
		'logitude',
		'is_deleted',
		'created_by',
		'updated_at',
		'created_at',
	];
	

	public function getZone()
    {
        return $this->hasOne('App\Models\zone', 'zone_id', 'id');
    }
}
