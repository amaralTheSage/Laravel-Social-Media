<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    // REGISTERING  
    public function register()
    {
        return view('pages.register');
    }

    public function store(Request $request)
    {

        //"password-confirmation" is the convention for Laravel; It makes it so you don't need to write a bunch of code yourself.

        // Notice the 'confirmed' validation rule in 'password': it's all you need

        $validated = $request->validate([
            'username-box' => 'required|min:5|max:30|unique:users,username',
            'email-box' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'username' => $validated['username-box'],
            'email' => $validated['email-box'],
            'password' => Hash::make($validated['password'])
        ]);

        Mail::to($user->email)->send(new ConfirmationEmail($user));



        return redirect()->route('dashboard')->with('sucess', 'Account created succesfully!');
    }

    // LOGIN

    // Tried to put 'login' and 'register' straight into routes to clear up the controller -> didn't work (why?)
    public function login()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email-box' => 'required|email',
            'password' => 'required'
        ]);

        $authenticated = Auth::attempt([
            'email' => $validated['email-box'],
            'password' => $validated['password']
        ]);


        if ($authenticated) {
            // Clearing previous sessions (previously logged-in users)
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->withErrors(['login_fail', 'Invalid email or password.']);
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard');
    }
}
