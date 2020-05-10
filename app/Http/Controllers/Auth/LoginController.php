<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:App\User,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if (Auth::attempt($validatedData, boolval($request->input('remember')))) {
            return redirect('/');
        }
        return Redirect::back()
            ->withInput()
            ->withErrors(array('PasswordInput' => 'Invalid Password.'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
