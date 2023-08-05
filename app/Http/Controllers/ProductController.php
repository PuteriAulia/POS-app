<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $products = Product::where('product_status','active')->get();
            return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name', function($products){
                return ucwords($products->product_name);
            })
            ->addColumn('sell', function($products){
                return rupiahFormat($products->product_sell);
            })
            ->addColumn('purchase', function($products){
                return rupiahFormat($products->product_purchase);
            })
            ->addColumn('suplier', function($products){
                return ucwords($products->supliers->suplier_name);
            })
            ->addColumn('action',function($products){
                return view('product.btnEditDelProduct')->with('data',$products);
            })
            ->make(true);
        }
        return view('product.dataProduct');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supliers = Suplier::where('suplier_status','active')->get();
        return view('product.formStoreProduct',['supliers'=>$supliers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'     => 'required',
            'suplier'  => 'required',
            'purchase' => 'required',
            'sell'     => 'required',
        ],[
            'name.required'     => "Nama barang wajib diisi",
            'suplier.required'  => "Suplier wajib diisi",
            'purchase.required' => "Harga beli wajib diisi",
            'sell.required'     => "Harga jual wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            // Generate products code
            $maxId = Product::max('product_code');
            $intMaxId = (int) substr($maxId,2);

            if ($maxId == null) {
                $intMaxId = '0001';
            }else{
                $addIntMaxId = $intMaxId+1;
                $intMaxId = sprintf("%'.04d",$addIntMaxId);
            }   
            $newId = "BR".$intMaxId;

            // Store product
            Product::create([
                'product_code'  => $newId,
                'product_name'  => $request->name,
                'product_stock' => 0,
                'product_purchase' => $request->purchase,
                'product_sell'  => $request->sell,
                'product_status'=> 'active',
                'suplier_id'    => $request->suplier,
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
        $productId = Crypt::decrypt($id);
        $product = Product::where('id',$productId)->get();
        $supliers = Suplier::where('suplier_status','active')->get();
        
        return view('product.formEditProduct',[
            'products' => $product, 
            'supliers' => $supliers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productId = Crypt::decrypt($id);
        $validate = Validator::make($request->all(),[
            'name'      =>  'required',
            'suplier'   =>  'required',
            'purchase'  =>  'required',
            'sell'      =>  'required',
        ],[
            'name.required'     =>  "Nama wajib diisi",
            'suplier.required'  =>  "Suplier wajib diisi",
            'purchase.required' =>  "Harga beli wajib diisi",
            'sell.required'     =>  "Harga jual wajib diisi",
        ]);

        if ($validate->fails()) {
            return response()->json(['errors'=> $validate->errors()->toArray()]);
        }else{
            // Update suplier
            Product::where('id',$productId)->update([
                'product_name'    => $request->name,
                'suplier_id'      => $request->suplier,
                'product_purchase'=> $request->purchase,
                'product_sell'    => $request->sell,
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
    public function delete($id){
        $productId = Crypt::decrypt($id);
        Product::where('id',$productId)->update([
            'product_status' => 'inactive',
        ]);
        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }

    public function destroy(string $id)
    {
        //
    }
}
