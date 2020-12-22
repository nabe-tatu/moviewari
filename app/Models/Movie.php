<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use PhpParser\Builder;

class Movie extends Model
{

    public function movieUser()
    {
       // return $this->belongsToMany(User::class,'movie_user','user_id','movie_id');
        //return $this->belongsTo(MovieUser::class,'user_id','id');
        return $this->hasMany(MovieUser::class,'movie_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

//    public function scopeFilterMovie($query, Collection $search)
//    {
//        if (!empty($search->get('movie'))) {
//            $query->where('name', $search->get('movie'));
//        }
//        if (!empty($search->get('discount'))) {
//            $query->where('discount', $search->get('discount'));
//        }
//        if (!empty($search->get('date'))) {
//            $query->where('date', $search->get('date'));
//        }
//
//
//        $query->when($search->get('theater'), function ($query, $value) {
//            $query->whereHas('user', function ($query) use ($value) {
//                $query->where('name', $value);
//            });
//        });
//    }


}
