<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.login');
    }
    public function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max: 255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something went wrong');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::create($request->all());
            toastr()->success('User created');
            session()->flash('success', 'User created   successfully');
            return redirect()->route('auth.login');
        }
    }
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            toastr()->success('Login successful');
            return to_route('task.index');
            // return redirect()->intended('');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout()
    {
        // dd(auth()->user()->name);
        auth()->logout();
        toastr()->success('Logged out successfully');
        return redirect()->route('task.index');
    }
}
