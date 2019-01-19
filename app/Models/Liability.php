<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liability extends Model
{
    protected $table = 'liabilities';

    protected $fillable = [
        'name',
        'price'
    ];

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }
}
