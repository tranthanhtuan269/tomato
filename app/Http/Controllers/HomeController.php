<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Channel;
use App\Language;
use Illuminate\Http\Request;

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

    public function welcome(){
        $groups = auth()->user()->groups;

        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        $languages = Language::get();

        $channels = Channel::get();

        return view('home', ['groups' => $groups, 'users' => $users, 'user' => $user, 'languages' => $languages, 'channels' => $channels]);
    }

    public function profile(){
        return view('auth.profile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = auth()->user()->groups;

        $users = User::where('id', '<>', auth()->user()->id)->get();
        $user = auth()->user();

        return view('home', ['groups' => $groups, 'users' => $users, 'user' => $user]);
    }
}
