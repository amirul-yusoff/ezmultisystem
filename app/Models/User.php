<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone_number',
        'password',
        'phone_number',
        'attachment',
        'user_group',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany('App\Models\roles');
    }
    
	public function getFiles()
    {
        return $this->hasMany('App\Models\users_has_pictures', 'users_id', 'id');
    }

    public function getOneProfilePicture()
	{
		return $this->hasOne('App\Models\users_has_pictures', 'users_id', 'id')->orderby('id','DESC');
	}
}
