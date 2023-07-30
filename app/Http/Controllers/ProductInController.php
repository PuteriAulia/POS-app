<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $productsIn = ProductIn::all();
            return DataTables::of($productsIn)
            ->addIndexColumn()
            ->addColumn('name', function($productsIn){
                return ucwords($productsIn->product->product_name);
            })
            ->addColumn('date', function($productsIn){
                return Carbon::parse($productsIn->productIn_date)->translatedFormat('d F Y');
            })
            ->addColumn('action',function($productsIn){
                return view('productIn.btnEditDelProduct')->with('data',$productsIn);
            })
            ->make(true);
        }
        return view('productIn.dataProductIn');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('product_status','active')->get();
        return view('productIn.formStoreProductIn',['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'product'   => 'required',
            'date'      => 'required',
            'qty'       => 'required',
        ],[
            'product.required'  => "Nama barang wajib diisi",
            'date.required'     => "Tanggal wajib diisi",
            'qty.required'      => "Qty wajib diisi",
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()->toArray()]);
        }else{
            // Generate products code
            $maxId = ProductIn::max('productIn_code');
            $intMaxId = (int) substr($maxId,3);

            if ($maxId == null) {
                $intMaxId = '0001';
            }else{
                $addIntMaxId = $intMaxId+1;
                $intMaxId = sprintf("%'.04d",$addIntMaxId);
            }
            $newId = "BRM".$intMaxId;

            // Incrase product stock
            $product = Product::where('id',$request->product)->get();
            foreach ($product as $data) {
                $oldStock = $data->product_stock;
                $newStock = $oldStock + $request->qty;
            }

            // Update product stock
            Product::where('id',$request->product)->update([
                'product_stock' => $newStock,
            ]);

            // Store productIn
            ProductIn::create([
                'productIn_code'  => $newId,
                'productIn_qty'   => $request->qty,
                'productIn_date'  => $request->date,
                'productIn_info'  => $request->desc,
                'product_id'      => $request->product,
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
        $productIn = ProductIn::where('id',$id)->get();

        foreach ($productIn as $data) {
            $productId = $data->product_id;
        }
        $product = Product::where('id',$productId)->get();
        foreach ($product as $item) {
            $productName = ucwords($item->product_name);
        }

        return response()->json([
            'status' => 'success',
            'productIn' => $productIn, 
            'productName' => $productName,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Decrease product stock
        $productIn = ProductIn::where('id',$id)->get();
        foreach ($productIn as $produckInData) {
            $productInQty = $produckInData->productIn_qty;
            $productInProductId = $produckInData->product_id;
        }

        $product = Product::where('id',$productInProductId)->get();
        foreach ($product as $productData) {
            $productStock = $productData->product_stock;
            $newStock     = $productStock-$productInQty;
        }

        Product::where('id',$productInProductId)->update([
            'product_stock' => $newStock,
        ]);

        // Delete productIn
        ProductIn::where('id',$id)->delete();

        return response()->json([
            'status' => 'success',
            'message'=> 'Data berhasil dihapus',
        ]);
    }
}