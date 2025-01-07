<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
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
            return redirect()->back()->with('errors', "Invalid credentials");
            // return redirect()->back()->with('errors', array('message' => $validator));
        } else {
            $data = $request->only('name', 'email', 'password');
            $user = User::create($data);
            if ($user) {
                return redirect()->route('auth.login')->with('success', 'User created   successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to create user');
            }
        }
    }
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => ['required', 'min:6'],
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        }
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return to_route('task.index')->with('success', 'Login successful');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.login')->with('success', 'Logged out successfully');
    }

    public function forgotPassword()
    {
        return view('auth.forgetPassword');
    }
    public function sendResetLink(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect()->back();
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            } else {
                // Send reset link
                $token = Str::random(64);
                $user->password_reset_token = $token;
                $user->password_reset_expires_at = now()->addMinutes(5);
                $user->save();
                // Send email with link
                Mail::to($user->email)->send(new ResetPasswordMail($token, $user->email));
                return redirect()->route('auth.login')->with('success', 'Reset link sent to your email');
            }
        }
    }

    // social login
    public function googlePage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $finduser = User::where('google_id', $user->id)->first();
        if ($finduser) {
            Auth::login($finduser);
            return to_route('task.index')->with('success', 'Login successful');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => encrypt('123456dummy'),
            ]);
            Auth::login($newUser);
            return to_route('task.index')->with('success', 'Login successful');

        }
    }
}
