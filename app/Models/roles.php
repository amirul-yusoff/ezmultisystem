<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
	protected $table = 'roles';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'name',
		'guard_name',
		'created_at',
		'updated_at',
		'created_by',
		'is_deleted',
	];

	public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

	public function getPermissions()
    {
        return $this->hasMany('App\Models\role_has_permissions', 'role_id', 'id');
    }
}
