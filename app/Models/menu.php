<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
	protected $table = 'menu';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'name',
		'description',
		'category',
		'price',
		'status',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'is_deleted',
		'availability',
		'user_id',
	];

	public function getFiles()
    {
        return $this->hasMany('App\Models\menu_has_pictures', 'menu_id', 'id');
    }

    public function getOneMenuPicture()
	{
		return $this->hasOne('App\Models\menu_has_pictures', 'menu_id', 'id')->orderby('id','DESC');
	}

	public function getOwner()
	{
		return $this->hasOne('App\Models\User', 'id', 'user_id');
	}
}
