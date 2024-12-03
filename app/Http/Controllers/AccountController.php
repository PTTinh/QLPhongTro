<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('account.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Vui lòng nhập email',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu'

        ]
    );

        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('login')->with('error', 'Đăng nhập thất bại, vui lòng kiểm tra lại email hoặc mật khẩu');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}
