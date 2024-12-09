<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request){

        if(!Auth::check()){

            return view('register');
        }

        return redirect()->route('dashboard');
    }

    public function login(Request $request){

        if(!Auth::check()){

            return view('login');
        }

        return redirect()->route('dashboard');
    }

    public function authenticate(Request $request){

       $credentials = $request->validate([
                    'email' => ['required', 'email', 'exists:users,email'],
                    'password' => ['required']
                ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'password' => 'credentials do not match.'
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
