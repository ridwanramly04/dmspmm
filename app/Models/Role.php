<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillabel = [
        'id',
        'level'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
