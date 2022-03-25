<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coupons extends Model
{
	protected $table = 'coupons';

	protected $primaryKey = 'id';

	public $timestamps = true;

	protected $fillable = [
		'coupon_code',
		'amount',
		'amount_type',
		'expiry_date',
		'status',
		'created_at',
		'updated_at',
		'was_used',
		'time_can_used',
		'created_by',
		'is_deleted',
	];

}
