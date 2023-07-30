<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authLogin(Request $request){
        // Check active account
        $checkUser = User::where('username',$request->username)->get();
        foreach ($checkUser as $user) {
            $status = $user->status;
        }

        if ($status === 'inactive') {
            Session::flash('status', 'gagal');
            Session::flash('message', 'User tidak aktif');

            return redirect('/login');
        }else{
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);
    
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
     
                return redirect()->intended('/');
            }
    
            Session::flash('status', 'gagal');
            Session::flash('message', 'Gagal login');
    
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
