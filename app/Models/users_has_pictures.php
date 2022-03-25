<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users_has_pictures extends Model
{
	protected $table = 'users_has_pictures';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'users_id',
		'filename',
		'hash',
		'description',
		'category',
		'mimetype',
		'size',
		'path',
		'upload_by',

	];
}
