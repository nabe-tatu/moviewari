<?php

namespace App;

use App\Models\Movie;
use App\Models\MovieUser;
use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use phpDocumentor\Reflection\Types\Collection;
use PhpParser\Builder;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movieUser()
    {
        return $this->hasMany(MovieUser::class,'user_id','id');
    }

//    public function scopeFilterUser(Builder $query, Collection $search)
//    {
//        if (!empty($search->get('theater'))) {
//            $query->where('name', $search->get('theater'));
//        }
//    }
}
