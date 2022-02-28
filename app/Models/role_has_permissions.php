<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role_has_permissions extends Model
{
	protected $table = 'role_has_permissions';

	protected $primaryKey = 'id';

	public $timestamps = false;

	protected $fillable = [
		'permission_id',
		'role_id',
	];

	public function getPermissionsName()
    {
        return $this->hasOne('App\Models\permissions', 'id', 'permission_id');
    }
}
