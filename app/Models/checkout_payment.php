<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class checkout_payment extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'checkout_payment';
	protected $primaryKey = 'id';
    protected $fillable = [
        'checkout_id',
        'total_price',
        'discount',
        'tax',
        'service',
        'is_paid',
        'created_at',
        'updated_at',
        'created_by',
        'paid_method',
        'total_price_all'
    ];

    public function menu()
    {
        return $this->hasOne('App\Models\menu', 'id', 'menu_id');
    }
    public function geDefaultAddress()
	{
		return $this->hasOne('App\Models\has_address', 'id', 'address_id');
	}

}
