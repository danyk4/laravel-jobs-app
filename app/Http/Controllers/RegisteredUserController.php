<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validate
        request()->validate([
          'first_name' => ['required'],
          'last_name' => ['required'],
          'email' => ['required', 'email', 'max:254'],
          'password' => ['required', Password::min(8), 'confirmed'],
            // look for next field password_confirmation
            //'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        // create the user
        $user = User::create([
          'first_name' => request('first_name'),
          'last_name' => request('last_name'),
          'email' => request('email'),
          'password' => request('password'),
          'admin' => 'false'
        ]);

        // log in
        Auth::login($user);

        // redirect
        return redirect('/jobs');
    }
}
