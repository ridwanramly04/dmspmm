<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'title',
        'dateline',
        'status',
        'message',
        'user_id',
        'assign_id',
        'client_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function assignTo()
    {
        return $this->belongsTo('App\User', 'assign_id');
    }

    public function asset()
    {
        return $this->hasMany('App\Models\Asset');
    }
    public function liability()
    {
        return $this->hasMany('App\Models\Liability');
    }
    public function document()
    {
        return $this->hasMany('App\Models\Document');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
