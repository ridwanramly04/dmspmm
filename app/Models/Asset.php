<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'name',
        'price'
    ];

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }
}
