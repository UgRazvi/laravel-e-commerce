<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard = ["id"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_no',
        'pincode',
        'address',
        'locality_town',
        'city',
        'state',
        'type', // Home or work
        'default_address',
        'birthday',
        'gender',
        'role',
        'roles',
        'status',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    use Notifiable;
    protected $casts = [
        'birthday' => 'date', // This will cast the birthday attribute to a Carbon instance
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class, 'user_id');
    }
    // User.php
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }


    //mutator and accessor 
}
