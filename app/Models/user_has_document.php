<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_has_document extends Model
{
	protected $table = 'user_has_document';

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
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
		'is_deleted',
	];
}
