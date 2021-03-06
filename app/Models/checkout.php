<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class checkout extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'menu_id',
        'type_payment',
        'checkout_id',
        'status',
        'price',
        'quantity',
        'is_paid',
        'merchant_id',
        'rider_id',
        'address_id'
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
