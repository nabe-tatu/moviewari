<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function movie()
    {
        return $this->hasMany(Movie::class,'category_id','id');
    }
}
