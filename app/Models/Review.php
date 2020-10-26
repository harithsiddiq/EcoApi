<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
