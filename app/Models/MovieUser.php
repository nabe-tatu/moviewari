<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;

class MovieUser extends Pivot
{

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }


    public function scopeFilterMovie($query, Collection $search)
    {
//        if (!empty($search->get('movie'))) {
//            $query->where('name', $search->get('movie'));
//        }
        if (!empty($search->get('discount'))) {
            $query->where('discount', '>=', $search->get('discount'));
        }
        if (!empty($search->get('date'))) {
            $query->where('date', $search->get('date'));
        }


        if (!($search->get('categoryId') === 0)){
            $query->when($search->get('categoryId'), function ($query, $value) {
                $query->whereHas('movie', function ($query) use ($value) {
                    $query->whereHas('category', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                });
            });
        }


        $query->when($search->get('movie'), function ($query, $value) {
            $query->whereHas('movie', function ($query) use ($value) {
                $query->where('name', 'like','%'.$value.'%');
            });
        });

        $query->when($search->get('theater'), function ($query, $value) {
            $query->whereHas('user', function ($query) use ($value) {
                $query->where('name', 'like','%'.$value.'%');
            });
        });
    }





//    public function getUserNameAttribute($key)
//    {
//        return $this->user()->name;
//    }


}
