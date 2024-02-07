<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorityController extends Controller
{
    /**
     * ログインを実行します。
     *
     * @param LoginRequest $request ログインリクエスト
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        return back()->withErrors([
            'email' => __('validation.custom.email.match'),
        ])->onlyInput('email');
    }

    /**
     * ログアウトを実行します。
     *
     * @param Request $request リクエスト
     * @return mixed
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('home');
    }
}
