<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function signIn(): Factory|View|Application
    {
        return view('auth.signIn');
    }

    public function login(SignInRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }

        return redirect("sign-in")->withSuccess('Login details are not valid');
    }

    public function signUp(): Factory|View|Application
    {
        return view('auth.signUp');
    }

    public function registrate(SignUpRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->createUser($data);
        auth()->login($user);

        return redirect("sign-in")->withSuccess('You have signed-in');
    }

    public function signOut(Request $request): Redirector|Application|RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
