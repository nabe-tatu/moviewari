<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MovieResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::orderBy('updated_at', 'desc')->get();

        //dd($movies);

        return MovieResource::collection($movies);
    }


    public function store(Request $request, Movie $movie)
    {

        //dd($request->input('picture'));


        $this->validate($request, [
            'name' => 'required|string|min:1|max:100',
            'site_url' => 'required|string|min:1|max:3000',
            'picture' => 'required',
            'category_id' => 'required',
        ]);

        //ファイル名を構築してストレージに保存、その名前でDBにも保存
        //拡張子付きでファイル名を取得
        $filenameWithExt = $request->file("picture")->getClientOriginalName();

        //ファイル名のみを取得
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //拡張子を取得
        $extension = $request->file("picture")->getClientOriginalExtension();

        //保存のファイル名を構築
        $filenameToStore = $filename."_".time().".".$extension;

        $path = $request->file("picture")->storeAs("public", $filenameToStore);

        $movie = new Movie();
        $movie->name = $request->input('name');
        $movie->picture = $filenameToStore;
        $movie->site_url = $request->input('site_url');
        $movie->category_id = $request->input('category_id');

        $movie->save();
        return new MovieResource($movie);

    }

    public function update(Request $request, Movie $movie)
    {

    //dd($request->input('picture'));

        $this->validate($request, [
            'name' => 'required|string|min:1|max:100',
            'site_url' => 'required|string|min:1|max:3000',
            'picture' => 'required',
            'category_id' => 'required'
        ]);

        //ファイル名を構築してストレージに保存、その名前でDBにも保存
        //拡張子付きでファイル名を取得
        $filenameWithExt = $request->file("picture")->getClientOriginalName();

        //ファイル名のみを取得
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //拡張子を取得
        $extension = $request->file("picture")->getClientOriginalExtension();

        //保存のファイル名を構築
        $filenameToStore = $filename."_".time().".".$extension;

        //ストレージに保存
        $path = $request->file("picture")->storeAs("public", $filenameToStore);

        //dd($filenameToStore);

        $movie->name = $request->input('name');
        $movie->site_url = $request->input('site_url');
        $movie->category_id = $request->input('category_id');

        $movie->picture = $filenameToStore;

        $movie->update();
        return new MovieResource($movie);
    }

    public function delete(Movie $movie)
    {
        $movie->delete();
        return response(null,204);
    }
}
