<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

            $role = Auth::user()->role;
            //ユーザの持つ権限ごとにリダイレクト先を分岐
            if ($role == '1') {
                return redirect('admin')->with('result', 'ログインしました');
            } elseif ($role == '2') {
                return redirect('owner')->with('result', 'ログインしました');
            } else {
                return redirect('mypage')->with('result', 'ログインしました');
            }

        } else {
            return redirect('login')->with('error', 'メールアドレスまたはパスワードが間違っています');
        }
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);

            return redirect('thanks');
        } catch (\Throwable $th) {
            return redirect('register')->with('error', '予期せぬエラーが発生しました');
        }
    }

    public function getThanks()
    {
        return view('auth.thanks');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('login')->with('result', 'ログアウトしました');
    }

    public function logoutGetRegister()
    {
        Auth::logout();
        return redirect('register');
    }
}
