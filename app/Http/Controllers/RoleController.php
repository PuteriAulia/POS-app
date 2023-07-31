<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $roles = Role::where('role_status','active')->get();
            return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('name', function($roles){
                return ucwords($roles->role_name);
            })
            ->addColumn('action',function($roles){
                return view('role.btnEditDelRole')->with('data',$roles);
            })
            ->make(true);
        }
        return view('role.dataRole');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'role_name' => 'required|unique:roles',
        ],[
            'role_name.required' => "Nama wajib diisi",
            'role_name.unique'   => "Role telah terdaftar",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            // Generate products code
            $maxId = Role::max('role_code');
            $intMaxId = (int) substr($maxId,2);

            if ($maxId == null) {
                $intMaxId = '0001';
            }else{
                $addIntMaxId = $intMaxId+1;
                $intMaxId = sprintf("%'.04d",$addIntMaxId);
            }   
            $newId = "RL".$intMaxId;

            // Store product
            Role::create([
                'role_code'  => $newId,
                'role_name'  => $request->role_name,
                'role_status'=> 'active',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::where('id',$id)->get();
        return response()->json([
            'status' => 'success',
            'data'   => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(),[
            'name'     => 'required',
        ],[
            'name.required'     => "Nama role wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            Role::where('id',$id)->update([
                'role_name' => $request->name,
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

    public function delete(string $id)
    {
        Role::where('id',$id)->update([
            'role_status' => 'inactive',
        ]);
        
        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }
}
