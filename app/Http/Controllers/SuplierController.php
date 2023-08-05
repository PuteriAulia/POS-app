<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $supliers = Suplier::where('suplier_status','active')->get();
            return DataTables::of($supliers)
            ->addIndexColumn()
            ->addColumn('name', function($supliers){
                return ucwords($supliers->suplier_name);
            })
            ->addColumn('address', function($supliers){
                return ($supliers->suplier_address);
            })
            ->addColumn('action',function($supliers){
                return view('supliers.btnEditDelSuplier')->with('data',$supliers);
            })
            ->make(true);
        }
        return view('supliers.dataSupliers');
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
            'name'     => 'required',
            'address'  => 'required',
            'phone'    => 'required',
        ],[
            'name.required'     => "Nama suplier wajib diisi",
            'address.required'  => "Alamat wajib diisi",
            'phone.required'    => "Nomor telepon wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            // Generate products code
            $maxId = Suplier::max('suplier_code');
            $intMaxId = (int) substr($maxId,3);

            if ($maxId == null) {
                $intMaxId = '0001';
            }else{
                $addIntMaxId = $intMaxId+1;
                $intMaxId = sprintf("%'.04d",$addIntMaxId);
            }
            $newId = "SUP".$intMaxId;

            // Store product
            $inp_address = $request->address;
            $inp_phone   = $request->phone;
            $inp_name    = $request->name;

            Suplier::create([
                'suplier_code'     => $newId,
                'suplier_name'     => $inp_name,
                'suplier_address'  => $inp_address,
                'suplier_phone'    => $inp_phone,
                'suplier_status'   => 'active',
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil ditambahkan',
        ]);
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
        $suplierId = Crypt::decrypt($id);
        $suplier = Suplier::where('id',$suplierId)->get();
        return response()->json([
            'status' => 'success',
            'data'   => $suplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $suplierId = Crypt::decrypt($id);
        $validate = Validator::make($request->all(),[
            'name'     => 'required',
            'address'  => 'required',
            'phone'    => 'required',
        ],[
            'name.required'     => "Nama suplier wajib diisi",
            'address.required'  => "Alamat wajib diisi",
            'phone.required'    => "Nomor telepon wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            Suplier::where('id',$suplierId)->update([
                'suplier_name'    => $request->name,
                'suplier_address' => $request->address,
                'suplier_phone'   => $request->phone,
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
        $suplierId = Crypt::decrypt($id);
        Suplier::where('id',$suplierId)->update([
            'suplier_status' => 'inactive',
        ]);
        
        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }
}
