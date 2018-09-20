<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use auth;
use Validator;

class ProfilController extends Controller
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
        $current = auth::user()->username;
        $profil = user::where('username', $current)->get();

        return view('/after/user', ['profil' => $profil]);
    }
    public function update(Request $request)
    {
        $old = auth::user()->username;
        $new = $request->username;
        $fullname = $request->fullname;
        $validator = Validator::make($request->all(), [
            'username' => 'string|unique:users|min:6',
        ]);

        if ($new == null)
        {
            user::where('username', $old)->update(['fullname' => $fullname]);
        }
        else 
        {
            if($validator->fails())
            {
                return redirect('/after/user')
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {
                user::where('username', $old)->update(['username' => $new, 'fullname' => $fullname]);
            }
        }
        return redirect('/after/user');
    }
}
