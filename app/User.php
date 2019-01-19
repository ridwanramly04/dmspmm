<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
    public function client()
    {
        return $this->hasOne('App\Models\Client');
    }
    public function report()
    {
        return $this->hasMany('App\Models\Report', 'id', 'user_id');
    }
    public function assign()
    {
        return $this->hasMany('App\Models\Report', 'id', 'assign_id');
    }
}
