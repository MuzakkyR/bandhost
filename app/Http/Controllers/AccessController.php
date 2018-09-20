<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use auth;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $userlist = user::all();

        if(Auth::user()->role == "admin")
        {
            return view('/after/access', ['userlist' => $userlist]);
        }
        else
        {
            return redirect()->route('notfound');
        }
    }
    public function refresh()
    {
        $admin = input::get('username');
        $updated = user::where('username', $admin)->update(['role' => 'admin']);

        return  redirect()->route('access');
    }
}
