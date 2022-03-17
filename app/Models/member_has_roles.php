<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member_has_roles extends Model
{
	protected $table = 'member_has_roles';

	protected $primaryKey = 'id';

	public $timestamps = false;
	
	protected $fillable = [
		'member_id',
		'role_id',
	];
	
	public function getRoleName()
    {
        return $this->hasOne('App\Models\roles', 'id', 'role_id');
    }

	public function getRolePermission()
    {
        return $this->hasMany('App\Models\role_has_permissions', 'role_id', 'role_id');
    }
}
