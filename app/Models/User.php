<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = ["id"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    //mutator and accessor 
}
