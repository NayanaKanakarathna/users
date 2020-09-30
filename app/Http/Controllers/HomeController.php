<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\users;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_level == "Super admin")
        {
            $users = users::OrderBy('created_at','asc')->get();
            return view("user.list")->with('users',$users);
        }
        else{
            return view('home');
        }
    }
}
