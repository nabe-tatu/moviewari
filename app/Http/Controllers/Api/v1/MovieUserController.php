<?php

namespace App\Http\Controllers\Api\v1;

use App\Example;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MovieUserResource;
use App\Models\Movie;
use App\Models\MovieUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieUserController extends Controller
{
//    protected $example;
//
//    public function __construct(Example $example)
//    {
//        $this->example = $example;
//    }
//
//    public function Example()
//    {
//        dd($this->example->DIExampleMethod());
//    }



    public function generalIndex(Request $request)
    {
        $movieUser = MovieUser::orderBy('date', 'asc')->get();

        return MovieUserResource::collection($movieUser);
    }


    public function index(Request $request, Example $example)
    {
        //dd($example->DIExampleMethod());

        $movieUser = $request->user()->movieUser()->orderBy('date', 'asc')->get();

        return MovieUserResource::collection($movieUser);
    }

    public function filteredIndex(Request $request)
    {

        $movieUser = MovieUser::FilterMovie(collect(json_decode($request->input('search'))))->orderBy('date', 'asc')->get();

        return MovieUserResource::collection($movieUser);

    }

    public function store(Request $request, MovieUser $movieUser)
    {
        $this->validate($request, [
            'movie_id' => 'required',
            'discount' => 'required|integer|min:1|max:10000',
            'date' => 'required',
            'time' => 'required',
            'url' => 'required|string|min:1|max:3000',
        ]);

        //$movieUser = new MovieUser();
        $movieUser->discount = $request->input('discount');
        $movieUser->date = $request->input('date');
        $movieUser->time = $request->input('time');
        $movieUser->url = $request->input('url');
        $movieUser->movie_id = $request->input('movie_id');
        $movieUser->user_id = $request->user()->id;
        $movieUser->save();

        return new MovieUserResource($movieUser);
    }

    public function update(Request $request, MovieUser $movieUser)
    {

        $this->validate($request, [
            'discount' => 'required|integer|min:1|max:10000',
            'date' => 'required',
            'time' => 'required',
            'url' => 'required|string|min:1|max:3000',
        ]);


        $movieUser->discount = $request->input('discount');
        $movieUser->date = $request->input('date');
        $movieUser->time = $request->input('time');
        $movieUser->url = $request->input('url');


        $movieUser->update();
        return new MovieUserResource($movieUser);
    }

    public function delete(MovieUser $movieUser)
    {
        $movieUser->delete();
        return response(null,204);
    }


}
