<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Jobs\SendResetPassMailJob;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    // Show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = Hash::make($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }

    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // forgot password Form
    public function forgotPasswordForm()
    {
        return view('users.forgot-password');
    }

    // forgot password
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        if ($user->exists()) {
            $new_password = Str::random(8);
            $user->password = Hash::make($new_password);
            $user->save();
            dispatch(new SendResetPassMailJob($user, $new_password));
        }
        return redirect('/login');
    }
}
