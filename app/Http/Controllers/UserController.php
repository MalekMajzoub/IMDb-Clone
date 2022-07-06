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
    public function create() // Show Register/Create Form
    {
        return view('users.register');
    }

    public function store(Request $request) // Create New User
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $formFields['password'] = Hash::make($formFields['password']);
        $user = User::create($formFields);
        auth()->login($user);
        return redirect()->route('movies.all');
    }


    public function logout(Request $request) // Logout User
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('movies.all');
    }

    public function login() // Show Login Form
    {
        return view('users.login');
    }

    public function authenticate(Request $request) // Authenticate User
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('movies.manage');
            } else {
                return redirect()->route('movies.all');
            }
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function forgotPasswordForm() // forgot password Form
    {
        return view('users.forgot-password');
    }

    public function forgotPassword(Request $request) // forgot password
    {
        $user = User::where('email', $request['email'])->first();
        if ($user->exists()) {
            $new_password = Str::random(8);
            $user->password = Hash::make($new_password);
            $user->save();
            dispatch(new SendResetPassMailJob($user, $new_password));
        }
        return redirect()->route('users.login');
    }
}
