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
	];

	public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
