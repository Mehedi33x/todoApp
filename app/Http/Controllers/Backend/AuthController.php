<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    /* public function register(){
        return view('auth.register');
    } */

    public function doLogin(Request $request){
        // dd($request->all());
        // validate the form dataa
        $this->validate($request, [
            'email' =>'required|email',
            'password' => 'required|min:6',
        ]);

        // attempt to log the user in
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            // if successful, redirect to intended page
            return redirect()->intended('/dashboard');
        }

        // if unsuccessful, redirect back to the login with the form data and errors
        return redirect()->back()->withInput($request->only('email','remember'))
            ->withErrors(['email' => 'Invalid email or password']);
    }
}
