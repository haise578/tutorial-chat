<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserInterface;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (Auth::id() != $user->id) {
            return abort(403);
        }
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::id() != $user->id) {
            return abort(403);
        }
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'profile' => ['required', 'string', 'max:100'],
        ]);
        $this->userRepository->update($validatedData, $user);
        return redirect(route('user.show', [
            'user'=> $user,
        ]));
    }

    public function destroy(User $user)
    {
        if (Auth::id() != $user->id) {
            return abort(403);
        }
        Auth::logout();
        $user->delete();
        return redirect(route('register'));
    }
}
