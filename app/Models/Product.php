<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

}
