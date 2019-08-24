<?php

namespace Figtest\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Eloquent\HybridRelations;    //It is used to relate mongo and mysql.

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    { 
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {    
        return [];
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Hash::make($password);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = ucfirst($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(Log::class)
            ->orderBy('created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class)
        ->orderBy('released_at')
        ->orderByDesc('created_at');
    }
}
