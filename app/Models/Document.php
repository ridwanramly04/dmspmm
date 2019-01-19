<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'name'
    ];

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }
}
