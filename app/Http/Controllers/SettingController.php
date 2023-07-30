<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function form_setting_account($id)
    {
        $account = User::where('id',$id)->get();
        return view('setting.accountSetting',['account' => $account]);
    }

    public function setting_account(Request $request)
    {
        User::where('id',$request->id)->update([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Data akun berhasil diubah');

        return redirect('/');
    }

    public function form_setting_password($id)
    {
        return view('setting.passwordSetting',['userId' => $id]);
    }

    public function setting_password(Request $request)
    {
        User::where('id',$request->id)->update([
            'password' => Hash::make($request->password),
        ]);
        
        Session::flash('status', 'success');
        Session::flash('message', 'Password berhasil diubah');

        return redirect('/');
    }
}
