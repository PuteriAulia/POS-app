<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $user = User::where('username',$request->username)->where('status','inactive')->get();
        $checkUser = count($user);

        if ($checkUser === 1) {
            Session::flash('status', 'failed');
            Session::flash('message', 'User tidak aktif');
            return redirect('/login');
        }else{
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ],[
                'username.required' => 'Username wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]);
    
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
