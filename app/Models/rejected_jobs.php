<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rejected_jobs extends Model
{
	protected $table = 'rejected_jobs';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'checkout_id',
		'user_id',
		'created_at',
		'updated_at',
		'reason',
	];

}
  
