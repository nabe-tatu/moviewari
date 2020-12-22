<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    public function index(Request $request)
    {
//        if ($request->user()->admin === 1){
//            return view('admin');
//        }
        return view('admin');
    }
}
