<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'company_name',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function report()
    {
        return $this->hasMany('App\Models\Report');
    }
}
