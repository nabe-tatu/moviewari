<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function user(Request $request)
    {
        //dd($request->user());
        $user = $request->user();
        //sleep(5);
        //dd($user);
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|min:1|max:10',
            'email' => 'required|string|min:1|max:100',
            'password' => 'required|string|min:6|max:10',
            'newPassword' => 'required|string|min:6|max:10',
            'confirmPassword' => 'required|string|min:6|max:10',
        ]);

        if (Hash::check($request->input('password'), Auth::user()->password)) {

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('newPassword'));

            $user->update();

            return new UserResource($user);
        }else{
            return 'パスワードが異なります';
        }
    }

    public function delete(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}
