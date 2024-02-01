<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Attempt to log in a user.
     *
     * @param Request $request The HTTP request.
     * @return RedirectResponse Redirect to the home page after login.
     */
    public function login(Request $request): RedirectResponse
    {
        $incomingFields = $request->validate(['loginname' => 'required', 'loginpassword' => 'required']);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    /**
     * Log out the authenticated user.
     *
     * @return RedirectResponse Redirect to the home page after logout.
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect("/");
    }

    /**
     * Register a new user.
     *
     * @param Request $request The HTTP request.
     * @return RedirectResponse Redirect to the home page after registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:16', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:200'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user =  User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }
}
