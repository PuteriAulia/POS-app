<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::where('status','active')->get();
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function($users){
                return ucwords(($users->role->role_name));
            })
            ->addColumn('action',function($users){
                return view('user.btnEditDelDetUser')->with('data',$users);
            })
            ->make(true);
        }
        return view('user.dataUser');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('role_status','active')->get();
        return view('user.formStoreUser',['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inp_name = $request->name;
        $inp_role = $request->role;
        $inp_email = $request->email;
        $inp_phone = $request->phone;
        $inp_username = $request->username;
        $inp_password = $request->password;

        // return $inp_role;

        $validate = Validator::make($request->all(),[
            'name'     => 'required',
            'role'     => 'required',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|numeric',
            'username' => 'required|unique:users',
            'password' => 'required',
        ],[
            'name.required'      => "Nama user wajib diisi",
            'role.required'      => "Role wajib diisi",
            'email.required'     => "Email wajib diisi",
            'email.email'        => "Wajib berformat email",
            'email.unique'       => "Email telah terdaftar",
            'phone.required'     => "Nomor telepon wajib diisi",
            'phone.numeric'      => "Nomor telepon berformat angka",
            'username.required'  => "Username wajib diisi",
            'username.unique'    => "Username telah terdaftar",
            'password.required'  => "Password wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            User::create([
                'name' => $inp_name,
                'username' => $inp_username,
                'email' => $inp_email,
                'phone' => $inp_phone,
                'role_id' => $inp_role,
                'password' => Hash::make($inp_password),
                'status' => 'active',
            ]);

            return response()->json([
                'status' => 'success',
                'message'=> 'Data berhasil ditambahkan',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id',$id)->get();
        $roles = Role::where('role_status','active')->get();

        return view('user.formEditUser',[
            'user' => $user,
            'roles'=> $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->role;
        $validate = Validator::make($request->all(),[
            'name'  =>  'required',
            'phone' =>  'required|numeric',
            'role'  =>  'required',
        ],[
            'name.required'  =>  "Nama wajib diisi",
            'phone.required' =>  "Nomor telepon wajib diisi",
            'phone.numeric'  =>  "Nomor telepon berformat angka",
            'role.required'  =>  "Role wajib diisi",
        ]);

        if ($validate->fails()) {
            return response()->json(['errors'=> $validate->errors()->toArray()]);
        }else{
            // Update suplier
            User::where('id',$id)->update([
                'name'    => $request->name,
                'phone'   => $request->phone,
                'role_id' => $request->role,
            ]);

            return response()->json([
                'status' => 'success',
                'message'=> 'Data berhasil diubah',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        User::where('id',$id)->update([
            'status' => 'inactive',
        ]);
        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }
}
