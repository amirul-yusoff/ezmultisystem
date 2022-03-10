<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_has_pictures extends Model
{
	protected $table = 'menu_has_pictures';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'menu_id',
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
