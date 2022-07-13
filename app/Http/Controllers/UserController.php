<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\AuthenticateUserRequest;
use App\Http\Requests\UserRequests\ForgotPasswordUserRequest;
use App\Http\Requests\UserRequests\StoreUserRequest;
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

    public function store(StoreUserRequest $request) // Create New User
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
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

    public function authenticate(AuthenticateUserRequest $request) // Authenticate User
    {
        $validated = $request->validated();

        if (auth()->attempt($validated)) {
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

    public function forgotPassword(ForgotPasswordUserRequest $request) // forgot password
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        if ($user) {
            $new_password = Str::random(8);
            $user->password = Hash::make($new_password);
            $user->save();
            dispatch(new SendResetPassMailJob($user, $new_password));
        }
        return redirect()->route('users.login');
    }
}
